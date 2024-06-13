<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_product_bills extends Model
{

    use HasFactory;
    public $timestamps = False;

    protected $table = 'detail_product_bills'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'name_product',
        'price',
        'amount_product',
        'state_record',
        'product_bills_id',
        'products_id'

    ];
}
