<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];

    public function taskPoints()
    {
        return $this->hasMany(TaskPoint::class, 'brand_id');
    }

    public function manajerial()
    {
        return $this->hasMany(Manajerial::class, 'brand_id');
    }
}



