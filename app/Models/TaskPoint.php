<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskPoint extends Model
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

    public function masterTask()
    {
        return $this->belongsTo(MasterTask::class, 'master_tasks_id', 'id');
    }
}
