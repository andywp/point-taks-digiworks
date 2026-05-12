<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manajerial extends Model
{
    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
