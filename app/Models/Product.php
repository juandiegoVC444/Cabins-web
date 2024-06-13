<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Product extends Model
{
    use HasFactory;
    public $timestamps = False;

    protected $guarded = ['id','update_time','create_time'];
    const  CREATED_AT = 'create_time';
    const  UPDATE_AT = 'update_time';
}

?>
