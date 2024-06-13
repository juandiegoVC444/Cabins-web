<?php

namespace App\Http\Controllers;
use App\Models\Detail_service;
use App\Models\Service;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Resource;
use DateTime;


class ServicesController extends Controller
{

    public static $Global = [];

    public function __construct()
    {


        $this->middleware('auth');

    }

    public function index()
    {

        $services = Service::with('detail_service','services_resource')->get();


        return view('modules.services.index', compact('services'));
    }


    public function create()
    {
        $services = Service::all();
        return view('modules.services.create', compact('services'));
    }


    public function store(Request $request)
    {
        $services = new Service();
        $services -> tittle =$request ->title;
        $services -> description =$request ->description;
        $services -> max_individuals =$request ->max_individuals;
        $services -> rules = $request -> rules;
        $services -> save();


        return redirect(route('services.index'))->with('ok','ok');
    }

    public function show($id)
    {
        $services = Service::with('detail_service')->find($id);
        return view('modules.services.show' ,compact('services'));
    }

    public function edit($id)
    {
        $services = Service::with('detail_service')->find($id);
        return view('modules.services.edit' ,compact('services'));
    }

    public function captureImg($id_services,$id_detail){

        $images_old = Resource::where('DETAIL_SERVICES_id',$id_detail)->pluck('url','id');
        session(['images_old' => $images_old]);
        return $this->detailEdit($id_services, $id_detail);

    }

    public function detailEdit($id_services,$id_detail)
    {
        $services = Service::find($id_services);
        $detail_services = Detail_service::find($id_detail);
        return view('modules.services.detailEdit' ,compact('services','detail_services'));
    }

    public function update(Request $request, $id)
    {

        $services = Service::findOrFail($id);
        $services -> tittle = $request ->tittle;
        $services -> description = $request ->description;
        $services -> max_individuals = $request ->max_individuals;
        $services -> rules = $request -> rules;
        $services -> save();

        return redirect(route('services.index',$id))->with('update','ok');
    }

    public function detailUpdate(Request $request, $id1,$id2)
    {

        $detail_services = Detail_service::findOrFail($id2);
        $detail_services -> tittle = $request ->tittle;
        $detail_services -> description = $request ->description;
        $detail_services -> save();

        return redirect(route('services.showDetails',$id1))->with('update','ok');
    }

    public function addDetail($id)
    {
        $services = Service::with('detail_service')->find($id);
        return view('modules.services.createDetail' ,compact('services'));

    }
    public function createDetail(Request $request, $id)
    {

        $services = Service::findOrFail($id);
        $detail_services = new Detail_service();
        $detail_services -> tittle = $request -> tittle;
        $detail_services -> description = $request -> description;
        $detail_services -> SERVICES_id = $services ->id;
        $detail_services-> save();
        return redirect(route('services.showDetails',$services->id))->with('ok','ok');
    }
    public function showDetails($id)
    {
        $services = Service::with('detail_service')->find($id);
        return view('modules.services.showDetails' ,compact('services'));

    }


    public function disableServices($id){
        $services = Service::findOrFail($id);

        if ($services->state_record == 'ACTIVAR') {
            $state_record = 'DESACTIVAR';
        } else {
            $state_record = 'ACTIVAR';
        }
        $services->state_record = $state_record;
        $services->save();

        return redirect()->back();
    }

 #Desactivar detalles servicios
    public function disableDetailServices($id){

        $detail_services = Detail_service::findOrFail($id);

        if ($detail_services->state_record == 'ACTIVAR') {
            $state_record = 'DESACTIVAR';
        } else {
            $state_record = 'ACTIVAR';
        }

        $detail_services->state_record =$state_record;
        $detail_services->save();

        return redirect()->back();
    }

    public function activeServices($id){
        $services = Service::findOrFail($id);

        if ($services->state_record = 'DESACTIVAR') {
            $state_record = 'ACTIVAR';
        } else {
            $state_record = 'DESACTIVAR';
        }
        $services->state_record = $state_record;
        $services->save();

        return redirect()->back();
    }

 #Activar detalles servicios
    public function activeDetailServices($id){

        $detail_services = Detail_service::findOrFail($id);

        if ($detail_services->state_record = 'DESACTIVAR') {
            $state_record = 'ACTIVAR';
        } else {
            $state_record = 'DESACTIVAR';
        }

        $detail_services->state_record = $state_record;
        $detail_services->save();

        return redirect()->back();
    }

    public function activeImg($id){

        $resources = Resource::findOrFail($id);

        if ($resources->state_record == 'DESACTIVAR') {
            $state_record = 'ACTIVAR';
        } else {
            $state_record = 'DESACTIVAR';
        }

        $resources->state_record = $state_record;
        $resources->save();
        return redirect()->back();
    }

    public function disableImg($id){

        $resources = Resource::findOrFail($id);

        if ($resources->state_record == 'ACTIVAR') {
            $state_record = 'DESACTIVAR';
        } else {
            $state_record = 'ACTIVAR';
        }

        $resources->state_record = $state_record;
        $resources->save();
        return redirect()->back();
    }

    //Funciones Imagenes
    public function addImage($service_id,$detail_id)
    {
        $services = Service::findOrFail($service_id);
        $detail_services= Detail_service::findOrFail($detail_id);
        if ($detail_services->resource->count()<=4){
            return view('modules.services.addImage', compact('services','detail_services'));
        }else{
            return redirect()->back()->with('error', 'ok');
        }
    }

    public function storeImage(Request $request,$service_id,$detail_id)
    {
        $detail_services= Detail_service::findOrFail($detail_id);
        $resources = new Resource();

        if (isset($_FILES['picture']) && ($_FILES['picture']['name']!=null))  {
            $fecha = new DateTime();
            $Types = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg');

            $picture = $fecha->getTimestamp() . "_" .  $_FILES['picture']['name']; //subir la imagen con tiempo diferente, para diferenciar el mismo nombre pero hora diferente
            $imagen_temporal = $_FILES['picture']['tmp_name'];
            $validation = $_FILES['picture']['type'];

            if (in_array($validation, $Types)) {

                move_uploaded_file($imagen_temporal, "storage/imgServices/" . $picture); //mover la imagen y guardarla en una carpeta

                $resources->url = $picture;
                $resources->DETAIL_SERVICES_id = $detail_services->id;
                $resources->save();
                return redirect(route('services.showDetails',$service_id))->with('save', 'ok');
            } else {

                return redirect()->back()->with('not', 'ok');
            }
        }
        return redirect()->back()->with('not', 'ok');
    }

    public function editImg($id_ser,$id_re,$id_de)
    {
        $services = Service::findOrFail($id_ser);
        $resources = Resource::findOrFail($id_re);
        $detail_services = Detail_service::findOrFail($id_de);
        return view('modules.services.editImg', compact('services','resources','detail_services'));
    }


    public function oldImg(Request $request,$id_services,$id_detail){

        $resources = new Resource;
        $images_old = session('images_old');
        $images_erase = session('$Global', []);

        foreach($images_erase as $image){
            unlink($image);
        }
        session()->forget('$Global');
       $array = $images_old->toArray();

       $Array_old = array_map(function ($url, $id) use ($id_detail) {
        return ['id' => $id, 'url' => $url, 'DETAIL_SERVICES_id' => $id_detail];
       }, $array, array_keys($array));

       foreach ($Array_old as $old) {
        $id = $old['id'];
        $url = $old['url'];
        $DETAIL_SERVICES_id = $old['DETAIL_SERVICES_id'];

        Resource::where('id',$id)->update([
            'url' => $url,
            'DETAIL_SERVICES_id' => $DETAIL_SERVICES_id
        ]);

        }
        return redirect(route('services.showDetails',$id_services))->with('cancelar','ok');
    }

    public function updateImg(Request $request,$id_ser,$id_re,$id_de)
    {
        $services = Service::findOrFail($id_ser);
        $resources = Resource::findOrFail($id_re);
        $detail_services = Detail_service::findOrFail($id_de);

        $rutaArchivo = public_path('storage/imgServices/') . '/' . $resources->url;

        if (isset($_FILES['picture']) && ($_FILES['picture']['name']!=null))  {
            $fecha = new DateTime();
            $Types = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg');

            $picture = $fecha->getTimestamp() . "_" .  $_FILES['picture']['name']; //subir la imagen con tiempo diferente, para diferenciar el mismo nombre pero hora diferente
            $imagen_temporal = $_FILES['picture']['tmp_name'];
            $validation = $_FILES['picture']['type'];

            if (in_array($validation, $Types)) {
                if (file_exists($rutaArchivo)) {
                    session()->push('$Global',public_path('storage/imgServices/') . '/' .$picture);
                }
                move_uploaded_file($imagen_temporal, "storage/imgServices/" . $picture);

                $resources->url = $picture;
                $resources->save();
                return redirect(route('services.detailEdit',['id' => $services->id,'de' => $detail_services->id]));

            } else {
                $resources->url = $request->pictureOld;
                $resources->save();
                return redirect()->back()->with('error', 'ok');
            }
        } else if (isset($_FILES['picture']) && ($_FILES['picture']['name']==null)){
            $resources->url = $request->pictureOld;
            $resources->save();
            return redirect(route('services.detailEdit',['id' => $services->id,'de' => $detail_services->id]));

        }
    }
    public function servicesviews(){
        $services = Service::with(['detail_service', 'services_resource' => function ($query) {
            $query->where('resources.state_record', 'ACTIVAR')->inRandomOrder()->limit(5);
        }])
        ->where('state_record', 'ACTIVAR')
        ->get();

      return view('customers.services.servicesviews', compact('services'));
    }

    public function detailservices($id){

        $services = Service::findOrFail($id);
        $details = Detail_service::with(['resource' => function ($query) {
            $query->where('state_record', 'ACTIVAR');
            }])
                ->where('SERVICES_id', $id)
                ->where('state_record', 'ACTIVAR')
                ->get();

        $seasons = DB::select('SELECT seasons.tittle, seasons.price, seasons.initial_date, seasons.final_date FROM seasons
                            INNER JOIN services_for_season ON services_for_season.SEASONS_id = seasons.id
                            INNER JOIN services ON services_for_season.services_id = services.id WHERE services.id = :id and seasons.state_record ="ACTIVAR"',['id' => $id]);

      return view('customers.services.servicesdetails', compact('details','services','seasons'));
}
}
