<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Detail_service;
use App\Models\Resource;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use DateTime;
use Illuminate\Support\Facades\Cache;

class shoppingCarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request, $id) # función para agregar los datos en la cache
    {
        $this->store($id, $request->amount_products);
        return redirect(route('shoppingCar.index')); # redirecciona a la vista del carrito
    }

    public function createServices($id, $ninos, $adultos, $fecha_inicial, $fecha_final) # función para agregar los datos en la cache
    {
        $fechasReformateadas = [];
        $detail = Detail_service::findOrFail($id);
        //Consulta a las temporadas
        $seasons = DB::select(
            'SELECT seasons.tittle, seasons.price, seasons.initial_date, seasons.final_date FROM seasons 
                            INNER JOIN services_for_season ON services_for_season.SEASONS_id = seasons.id
                            INNER JOIN services ON services_for_season.services_id = services.id WHERE services.id = :id',
            ['id' => $detail->SERVICES_id]
        );
        //reacomodacion del formato fecha de las temporadas DD-MM-YYYY                    
        foreach ($seasons as $season) {
            $fechaReformateada = [
                "tittle" => $season->tittle,
                "price" => $season->price,
                "initial_date" => date("d-m-Y", strtotime($season->initial_date)),
                "final_date" => date("d-m-Y", strtotime($season->final_date))
            ];
            $fechasReformateadas[] = $fechaReformateada;
        }
        //Validacion de los dias seleccionados con las temporadas 
        $arraytempVal = [];
        $daysfortemp = [];
        foreach ($fechasReformateadas as $rango) {
            $fechaInicial = $rango["initial_date"];
            $fechaFinal = $rango["final_date"];
            $titulo = $rango["tittle"];
            $precio = $rango["price"];

            $timestampFechaInicial = strtotime($fechaInicial);
            $timestampFechaFinal = strtotime($fechaFinal);

            if ($this->validarTemporada(strtotime($fecha_inicial), $timestampFechaInicial, $timestampFechaFinal) == true) {
                if ($this->validarTemporada(strtotime($fecha_final), $timestampFechaInicial, $timestampFechaFinal) == true) {
                    $temp = [
                        "tittle" => $titulo,
                        "price" => $precio,
                        "initial_temp" => $fechaInicial,
                        "final_temp" => $fechaFinal,
                        "initial_select" => $fecha_inicial,
                        "final_select" => $fecha_final
                    ];
                    $day = $this->compararFechas($fecha_final, $fecha_inicial);
                    $dayA = [
                        "tittle" => $titulo,
                        "price" => $precio,
                        "days" => $day
                    ];
                    $daysfortemp[] = $dayA;
                    $arraytempVal[] = $temp;
                } else {
                    $temp = [
                        "tittle" => $titulo,
                        "price" => $precio,
                        "initial_temp" => $fechaInicial,
                        "final_temp" => $fechaFinal,
                        "initial_select" => $fecha_inicial,
                    ];
                    $day = $this->compararFechas($fechaFinal, $fecha_inicial);
                    $dayA = [
                        "tittle" => $titulo,
                        "price" => $precio,
                        "days" => $day
                    ];
                    $daysfortemp[] = $dayA;
                    $arraytempVal[] = $temp;
                }
            } else {
                if ($this->validarTemporada(strtotime($fecha_final), $timestampFechaInicial, $timestampFechaFinal) == true) {
                    $temp = [
                        "tittle" => $titulo,
                        "price" => $precio,
                        "initial_temp" => $fechaInicial,
                        "final_temp" => $fechaFinal,
                        "final_select" => $fecha_final,
                    ];
                    $day = $this->compararFechas($fechaFinal, $fecha_final);
                    $dayA = [
                        "tittle" => $titulo,
                        "price" => $precio,
                        "days" => $day
                    ];
                    $daysfortemp[] = $dayA;
                    $arraytempVal[] = $temp;
                }
            }
        }
        $maxDays = 0;
        $prices = null;
        $totalDays = 0;

        foreach ($daysfortemp as $record) {
            $days = $record["days"];
            $totalDays += $days;

            if ($days > $maxDays) {
                $maxDays = $days;
                $prices = $record;
            }
        }
        $multi = $prices["price"] * $totalDays;
        $this->storeServices($id, $ninos, $adultos, $fecha_inicial, $fecha_final, $multi, $totalDays);
        return redirect(route('shoppingCar.index')); # redirecciona a la vista del carrito
    }


    function validarTemporada($timestampFecha, $timestampFechaInicial, $timestampFechaFinal)
    {

        if ($timestampFecha >= $timestampFechaInicial && $timestampFecha <= $timestampFechaFinal) {

            return true;
        } else {
            return false;
        }
    }

    function compararFechas($primera, $segunda)
    {
        $valoresPrimera = explode("-", $primera);
        $valoresSegunda = explode("-", $segunda);

        $diaPrimera    = $valoresPrimera[0];
        $mesPrimera  = $valoresPrimera[1];
        $anyoPrimera   = $valoresPrimera[2];

        $diaSegunda   = $valoresSegunda[0];
        $mesSegunda = $valoresSegunda[1];
        $anyoSegunda  = $valoresSegunda[2];

        $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);
        $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);

        if (!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)) {
            // "La fecha ".$primera." no es v&aacute;lida";
            return 0;
        } elseif (!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)) {
            // "La fecha ".$segunda." no es v&aacute;lida";
            return 0;
        } else {
            return  $diasPrimeraJuliano - $diasSegundaJuliano;
        }
    }

    public function edit($id, $cantidad) # función para actualizar los datos en la cache
    {
        $this->update($id, $cantidad);
        return ['estado' => 'success'];
    }

    public function editServicesA($id, $cantidad) # función para actualizar los datos en la cache
    {
        $this->updateServicesA($id, $cantidad);
        return ['estado' => 'success'];
    }

    public function editServicesN($id, $cantidad) # función para actualizar los datos en la cache
    {
        $this->updateServicesN($id, $cantidad);
        return ['estado' => 'success'];
    }

    public function update($id, $cantidad) # función para actualizar los datos en la cache
    {
        $registro = Cache::get($id);
        $datos['id'] = $registro->id ?? '';
        $datos['nombre'] = $registro->nombre ?? '';
        $datos['precio'] = $registro->precio ?? 0;
        $datos['imagen'] = $registro->imagen ?? '';
        $datos['cantidad'] = $cantidad ?? 1;
        $datos = json_decode(json_encode($datos));
        Cache::forever($id, $datos);
    }

    public function updateServicesA($id, $cantidad) # función para actualizar los datos en la cache
    {

        $registro = Cache::get($id);
        $id_service = intval($registro->id);
        $detail = Detail_service::findOrFail($id_service);
        $service = Service::findOrFail($detail->SERVICES_id);

        $datosServices['id'] = $registro->id ?? '';
        $datosServices['nombre'] = $registro->nombre ?? '';
        $datosServices['cantidad_adultos'] = $cantidad ?? 1;
        $datosServices['cantidad_ninos'] = $registro->cantidad_ninos ?? 0;
        $datosServices['fecha_inicial'] = $registro->fecha_inicial ?? '';
        $datosServices['fecha_final'] = $registro->fecha_final ?? '';
        $datosServices['precio'] = $registro->precio ?? 0;
        $datosServices['imgServicios'] = $registro->imgServicios ?? '';
        $datosServices['dias'] = $registro->dias ?? 1;

        $datos = $datosServices['cantidad_ninos'] + $datosServices['cantidad_adultos'];


        if ($datos <= $service->max_individuals) {
            $datos = json_decode(json_encode($datosServices));
            Cache::forever($id, $datos);
        } else {
            return redirect()->back()->with('error', 'ok');
        }
    }

    public function updateServicesN($id, $cantidad) # función para actualizar los datos en la cache
    {

        $registro = Cache::get($id);
        $id_service = intval($registro->id);
        $detail = Detail_service::findOrFail($id_service);
        $service = Service::findOrFail($detail->SERVICES_id);
        $datosServices['id'] = $registro->id ?? '';
        $datosServices['nombre'] = $registro->nombre ?? '';
        $datosServices['cantidad_adultos'] = $registro->cantidad_adultos ?? 1;
        $datosServices['cantidad_ninos'] = $cantidad;
        $datosServices['fecha_inicial'] = $registro->fecha_inicial ?? '';
        $datosServices['fecha_final'] = $registro->fecha_final ?? '';
        $datosServices['precio'] = $registro->precio ?? 0;
        $datosServices['imgServicios'] = $registro->imgServicios ?? '';
        $datosServices['dias'] = $registro->dias ?? 1;

        $datos = $datosServices['cantidad_ninos'] + $datosServices['cantidad_adultos'];

        if ($datos <= $service->max_individuals) {

            $datos = json_decode(json_encode($datosServices));
            Cache::forever($id, $datos);
        } else {
            return redirect()->back()->with('error', 'ok');
        }
    }

    public function store($id, $cantidad, $type = 'product') # función para guardar los datos en la cache
    {
        $user = auth()->user();
        # Consultar el producto
        $product = Product::findOrFail($id);
        # En un arreglo guardamos los datos que necesitamos mostrar o traer a la vista del carrito
        $datos['id'] = $product->id ?? '';
        $datos['nombre'] = $product->name_product ?? '';
        $datos['precio'] = $product->price ?? 0;
        $datos['imagen'] = $product->picture ?? '';
        $datos['cantidad'] = $cantidad ?? 1;
        # Se modifica el arreglo como un string en forma de json y despues se pasa el string a un json
        $datos = json_decode(json_encode($datos));
        Cache::forever($type . $user?->id . $product?->id, $datos);
    }



    public function storeServices($id, $ninos, $adultos, $fecha_inicial, $fecha_final, $precio, $totalDays, $type = 'detail_service') # función para guardar los datos en la cache
    {
        $user = auth()->user();
        # Consultar el servicio
        $detailService = Detail_service::findOrFail($id);


        $resource = Resource::where('DETAIL_SERVICES_id', '=', $id)->first();
        # En un arreglo guardamos los datos que necesitamos mostrar o traer a la vista del carrito
        $datosServices['id'] = $detailService->id ?? '';
        $datosServices['nombre'] = $detailService->tittle ?? '';
        $datosServices['cantidad_adultos'] = $adultos ?? 1;
        $datosServices['cantidad_ninos'] = $ninos ?? 0;
        $datosServices['fecha_inicial'] = $fecha_inicial ?? '';
        $datosServices['fecha_final'] = $fecha_final ?? '';
        $datosServices['precio'] = $precio ?? 0;
        $datosServices['imgServicios'] = $resource->url ?? '';
        $datosServices['dias'] = $totalDays ?? 1;



        # Se modifica el arreglo como un string en forma de json y despues se pasa el string a un json
        $datosServices = json_decode(json_encode($datosServices));
        Cache::forever($type . $user?->id . $detailService?->id, $datosServices);
    }

    public function index(Request $request) # función para mostrar la vsta del carrito
    {

        // Cache::flush();
        $user = auth()->user();
        $keys = Product::all()->pluck('id')->toArray(); # se consultan todos los productos y los convertimos a arreglo
        $cont = 0;
        foreach ($keys as $key) {
            $keys[$cont] = 'product' . $user?->id . $key;
            $cont++;
        }

        $keyDetails = Detail_service::all()->pluck('id')->toArray();
        $contDetail = 0;
        foreach ($keyDetails as $keyDetail) {
            $keyDetails[$contDetail] = 'detail_service' . $user?->id . $keyDetail;
            $contDetail++;
        }

        # consultamos todos los productos en la cache con los id de los productos (llaves)
        $products = Cache::many($keys);
        $detailServices = Cache::many($keyDetails);



        return view('customers.shoppingCar.shoppingcar', compact('products', 'detailServices'));
    }

    public function delete()
    {
        // $products = [
        //     "id" => "",
        //     "name_product" => "",
        //     "decripcion" => "",
        //     "price" => 0,
        //     "picture" => "",
        //     "create_time" => "",
        //     "update_time" => "",
        //     "state_record" => ""
        // ];
        $user = auth()->user();
        $userId = $user->id;
        $keys = Product::all()->pluck('id')->toArray(); # se consultan todos los productos y los convertimos a arreglo
        foreach ($keys as $key) {
            $idRegistro = 'product' . $userId . $key;
            Cache::flush($idRegistro);
        }

        $keyDetails = Detail_service::all()->pluck('id')->toArray();
        foreach ($keyDetails as $keyDetail) {
            $idRegistro = 'detail_service' . $userId . $keyDetail;
            Cache::flush($idRegistro);
        }
        // Cache::flush(); # Se elimina todo lo que coincida con las llaves

        // return view('customers.shoppingCar.shoppingcar', compact('products'));
        return redirect(route('shoppingCar.index')); # redirecciona a la vista del carrito
    }

    public function clearProduct($id)
    {
        $user = auth()->user();
        $userId = $user->id;
        $key = $id; // Construir la llave de caché para el producto a eliminar
        Cache::forget($key); // Eliminar el elemento de la caché con la llave especificada


        // Obtener los productos restantes en la caché
        // $products = [
        //     "id" => "",
        //     "name_product" => "",
        //     "decripcion" => "",
        //     "price" => 0,
        //     "picture" => "",
        //     "create_time" => "",
        //     "update_time" => "",
        //     "state_record" => ""
        // ];
        // $user = auth()->user();
        // $keys = Product::all()->pluck('id')->toArray(); # se consultan todos los productos y los convertimos a arreglo
        // foreach ($keys as $index => $key) {
        //     $keys[$index] = 'product'.$user?->id . $key;
        // }
        // # consultamos todos los productos en la cache con los id de los productos (llaves)
        // $products = Cache::many($keys);

        // return view('customers.shoppingCar.shoppingcar', compact('products'));
        return redirect(route('shoppingCar.index')); # redirecciona a la vista del carrito
    }
}
