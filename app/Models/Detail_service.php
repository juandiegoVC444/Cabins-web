<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Detail_service extends Model
{


    public function resource(): HasMany
    {
        return $this->hasMany(Resource::class,"DETAIL_SERVICES_id","id");
    }
    use HasFactory;
    public $timestamps = False;
}
