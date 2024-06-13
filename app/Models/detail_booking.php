<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_booking extends Model
{
    use HasFactory;
    public $timestamps = False;
    protected $table = 'detail_booking'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'state_record',
        'BOOKING_id',
        'DETAIL_SERVICES_id',
        'product_bills_id',
        'service_bills_id',

    ];
}
