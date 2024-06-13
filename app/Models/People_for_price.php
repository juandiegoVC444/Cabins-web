<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class People_for_price extends Model
{
   //public function types_individual()
  //  {
   //     return $this->hasOne(Types_individual::class,'id', 'TYPES_INDIVIDUALS_id');
   // }
   
   public function types_individual(): BelongsTo
    {
        return $this->belongsTo(Types_individual::class,'id','TYPES_INDIVIDUALS_id');
    }
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class,'id','SERVICES_id');
    }
    use HasFactory;
   
    //En caso de fallas en fechas BORRAR
   public $timestamps = False;
}
