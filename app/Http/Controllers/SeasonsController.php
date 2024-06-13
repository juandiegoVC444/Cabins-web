<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeasonRequest;
use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;


class SeasonsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $servi = Service::all();
        $season = Season::all();
        return view('modules.seasons.index', compact('season','servi'));
    }

    public function create()
    {
        $season = Season::all();
        $servi = Service::all();
        return view('modules.seasons.create', compact('season','servi'));
    }

    public function store(SeasonRequest $request )
    {
        if ($request->input('error')) {
            return redirect()->back()-> withErrors(['message'=> $request->input('mensaje')]);
        }
        $seasons = new Season();

        $seasons -> tittle = $request -> tittle;
        $seasons -> description = $request -> description;
        $seasons -> initial_date = $request -> initial_date;
        $seasons -> final_date = $request -> final_date;
        $seasons -> price = $request ->price;
        $seasons-> save();

        $servId = $request->input('tittleServi');
        $seasons->services()->attach($servId);

        return redirect(route('seasons.index'))->with('ok','ok');

    }

    public function show($id)
    {
        $season = Season::findOrFail($id);
        $service = $season->services->first();
        return view('modules.seasons.show', compact('season','service'));

    }

    public function edit($id)
    {
        $season = Season::findOrFail($id);
        $service = $season->services->first();
        return view('modules.seasons.edit',compact('season','service'));
    }

    public function update(Request $request, $id)
    {
        $seasons = Season::findOrFail($id);

        $seasons -> tittle = $request -> tittle;
        $seasons -> description = $request -> description;
        $seasons -> initial_date = $request -> initial_date;
        $seasons -> final_date = $request -> final_date;
        $seasons -> price = $request ->price;
        $seasons-> save();

        return redirect(route('seasons.index'))->with('ok','ok');
    }

    public function consulta()
    {
        $seasonId = 1;

        $seasons = Season::table('seasons')
                ->join('services_for_season', 'seasons.id', '=', 'services_for_season.SEASONS_id')
                ->join('detail_services', 'services_for_season.id', '=', 'detail_services.SERVICES_id')
                ->join('services', 'detail_services.SERVICES_id', '=', 'services.id')
                ->select('seasons.id', 'seasons.tittle', 'seasons.description', 'seasons.initial_date','seasons.final_date','seasons.price')
                ->where('seasons.id', '=', $seasonId)
                ->get();

                return view('modules.seasons.index', ['seasons' => $seasons]);

    }
    public function disableSeasons($id)
    {
        $seasons = Season::findOrFail($id);

        if ($seasons->state_record = 'ACTIVAR') {
            $seasons->state_record = 'DESACTIVAR';
        } else {
            $seasons->state_record = 'ACTIVAR';
        }
        $seasons->save();
        return redirect()->back();
    }
    public function activeSeasons($id)
    {
        $seasons = Season::findOrFail($id);

        if ($seasons->state_record = 'DESACTIVAR') {
            $seasons->state_record = 'ACTIVAR';
        } else {
            $seasons->state_record = 'DESACTIVAR';
        }
        $seasons->save();
        return redirect()->back();
    }

    public function showDetail($id)
    {
        $service = Service::find($id);
        $season = $service->seasons;

        return view('modules.seasons.showDetail', compact('season','service'));

    }

    public function date(Request $request){

        $validator = Validator::make($request->all(), [
            'fecha_reserva' => 'required|date|after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Resto del código para guardar la reserva

        return redirect()->back()->withSuccess('Reserva creada exitosamente');
    }

}
