<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterTask extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function getPerHariAttribute($value)
    {
        return $value == 0 ? '' : $value;
    }

    public function getPerBulanAttribute($value)
    {
        return $value == 0 ? '' : $value;
    }

    public function taskPoints()
    {
        return $this->hasMany(TaskPoint::class, 'master_tasks_id', 'id');
    }
}
