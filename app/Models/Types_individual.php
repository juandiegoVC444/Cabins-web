<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Types_individual extends Model
{
   
    public function type_for_service(): HasMany
    {
        return $this->hasMany(Type_for_service::class,'TYPES_INDIVIDUALS_id','id');
    }

    public function services(): HasOneThrough
    {
        return $this->hasOneThrough(Service::class, Type_for_service::class, 'TYPES_INDIVIDUALS_id', 'id', 'id', 'SERVICES_id');
    }
    use HasFactory;
    public $timestamps = False;
}
