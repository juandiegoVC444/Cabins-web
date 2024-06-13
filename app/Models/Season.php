<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function services()
    {
        return $this->belongsToMany(Service::class, 'services_for_season','SEASONS_id','services_id');
    }

    use HasFactory;
    public $timestamps = False;
}
