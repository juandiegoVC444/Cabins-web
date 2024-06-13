<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_service_bills extends Model
{
    use HasFactory;
    public $timestamps = False;
    protected $table = 'detail_service_bills'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'amount_adults',
        'amount_child',
        'tittle',
        'state_record',
        'service_bills_id',
        'detail_services_id'
        
    ];
}
