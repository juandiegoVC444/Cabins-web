<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Pqrs;
use Illuminate\Http\Request;
use DateTime;

class PqrsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Funcion para ver los PQRS activos
    public function index()
    {
        $pqrs = Pqrs::select('*')
            ->where('state_record', '=', 'ACTIVAR')
            ->get();
        return view('modules.pqrs.index')->with('pqrs', $pqrs);
    }

    //Funcion para ver el PQRS
    public function show(Pqrs $pqr)
    {
        $id = $pqr->bookings_id;
        $code = Bookings::select('booking_code')
            ->where('id', '=', $id)
            ->get();
        $code = $code[0]->booking_code;

        return view('modules.pqrs.update', compact('pqr', 'code'));
    }

    // Funcion para eliminar o desactivar el Pqrs
    public function disableProducts($id)
    {
        $pqrs = Pqrs::findOrFail($id);
        if ($pqrs->state_record == 'ACTIVAR') {
            $pqrs->state_record = 'DESACTIVAR';
        }
        $pqrs->save();
        return redirect()->route('pqrs.index');
    }

    // Funcion para cambiar la gestion del Pqrs
    public function update(Request $request, $id)
    {
        $pqrs = Pqrs::find($id);
        $validatedData = $request->validate([
            'condition' => 'required|string|max:15'
        ]);
        $pqrs->condition = $request->input('condition');
        $pqrs->save();
        return redirect()->route('pqrs.index')->with('update', 'ok');
    }

    // Funcion para la vista de crear Pqrs
    public function create()
    {
        return view('customers.pqrs.create');
    }
    // Funcion para crear Pqrs
    public function store(Request $request)
    {
        $validar_id = Bookings::select('id')
            ->where('booking_code', '=', $request->post('bookings_code'))
            ->get();

        if ($validar_id == "[]") {
            return redirect()->back()->with('error', 'ok');
            return redirect()->route('pqrs.create')->with('error', 'ok');
        } else {
            $id = $validar_id[0]->id;
            $pqrs = new Pqrs;

            $pqrs->name_user = $request->post('name_user');
            $pqrs->phone_user = $request->post('phone_user');
            $pqrs->bookings_id = $id;
            $pqrs->type = $request->post('type');
            $pqrs->reason = $request->post('reason');
            $pqrs->description = $request->post('description');

            $fecha = new DateTime();
            //METODO PARA LA EVIDENCIA O IMAGEN
            if (isset($_FILES['evidence']) && ($_FILES['evidence']['name'] != null)) {
                $fecha = new DateTime();
                $Types = array('application/pdf');

                $evidence = $fecha->getTimestamp() . "_" . $_FILES['evidence']['name']; //subir la imagen con tiempo diferente, para diferenciar el mismo nombre pero hora diferente
                $imagen_temporal = $_FILES['evidence']['tmp_name'];
                $validation = $_FILES['evidence']['type'];

                if (in_array($validation, $Types)) {
                    move_uploaded_file($imagen_temporal, "storage/PQRS_FILES/" . $evidence); //mover la imagen y guardarla en una carpeta
                    print_r($evidence);
                    $pqrs->evidence = $evidence;
                }
            }
            //METODO PARA CREAR EL NUMERO DE RADICADO ALEATORIO, CON VALIDACION DE QUE NO EXISTA EN LA DB
            function generarCodigo($longitud)
            {
                do {
                    $caracteres = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    $codigo = "";
                    for ($i = 0; $i < $longitud; $i++) {
                        $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
                    }

                    $resultado = Pqrs::select('file_number')
                        ->where('file_number', '=', $codigo)
                        ->get();
                } while ($resultado != "[]");

                return $codigo;
            }

            $codigo = generarCodigo(10);
            $pqrs->file_number = $codigo;
            $pqrs->save();

            return redirect()->route('pqrs.create')->with('save', $codigo);
        }
    }
}
