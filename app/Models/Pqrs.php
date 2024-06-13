<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Pqrs extends Model
{
    use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    public $timestamps = False;

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
    protected $guarded = ['id', 'type', 'description', 'condition', 'name_user', 'phone_user', 'reason', 'evidence', 'file_number',
                        'create_time', 'update_time', 'state_record', '	bookings_id'];

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


    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}
