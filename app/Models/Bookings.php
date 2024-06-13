<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Bookings extends Model
{
    use HasFactory;
    public $timestamps = False;
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    protected $table = 'Bookings'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'final_date',
        'initial_date',
        'total',
        'booking_code',
        'pay_status',
        'state_record',
        'PAYMENT_METHODS_id',
        'USERS_id'
        
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = ['id', 'update_time', 'create_time'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}

?>