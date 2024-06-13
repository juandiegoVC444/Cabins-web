<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_bills extends Model

{

    use HasFactory;
    public $timestamps = False;
    protected $table = 'product_bills'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'id_user',
        'total',
        'state_record'
        
    ];
}
