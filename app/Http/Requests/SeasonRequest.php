<?php

namespace App\Http\Requests;

use App\Models\Season;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class SeasonRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "initial_date" => ['required',$this -> validarFechaSeason(), $this->validarFecha()]
        ];
    }

    public function validarFechaSeason()
    {
        $fechas = Season::where("state_record","ACTIVAR")
            ->whereHas('services', function($query) {
                $query->where('services_id', $this->get('tittleServi'));
            })->get();
        $fecha_inicio_a = Carbon::parse($this -> get("initial_date"));
        $fecha_final_a = Carbon::parse($this -> get("final_date"));
        $error = 0;
        $mensaje = '';
        foreach($fechas as $fecha){
            $f_inicio = Carbon::parse($fecha->initial_date);
            $f_final = Carbon::parse($fecha->final_date);

            if ($fecha_inicio_a->lessThan($f_final) && $fecha_inicio_a->greaterThan($f_inicio)) {
                $error++;
                $mensaje = "Las fechas ya estan asignadas a una temporada en este servicio";
            }else if ($fecha_final_a->lessThan($f_final) && $fecha_final_a->greaterThan($f_inicio)) {
                $error++;
                $mensaje = "Las fechas ya estan asignadas a una temporada en este servicio";
            }
            if ($fecha_inicio_a->equalTo($f_inicio)) {
                $error++;
            }if ($fecha_final_a->equalTo($f_final)) {
                $error++;
            }

        }
        if ($error) {
            $this->merge(['error' => true]);
            $this->merge(['mensaje' => $mensaje]);
        }
    }

    public function validarFecha() {
        $fecha_inicio_a = Carbon::parse($this -> get("initial_date"));
        $fecha_final_a = Carbon::parse($this -> get("final_date"));
        $error = 0;
        $mensaje = '';
        if ($fecha_final_a->lessThan($fecha_inicio_a)) {
            $error++;
            $mensaje = 'La fecha final no puede ser antes que la fecha de inicio';
        }
        if ($error) {
            $this->merge(['error' => true]);
            $this->merge(['mensaje' => $mensaje]);
        }
    }
}
