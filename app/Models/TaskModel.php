<?php

namespace App\Models;

use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    use Uuids;

    protected $table='tasks';
    public $incrementing= false;
    protected $primaryKey = 'uuid';
    public $timestamps = false;

    public function scheduleTask(){
        return $this->belongsTo(SchedulesModel::class,'schedule_uuid');
    }

    public function taskCategory(){
        return $this->belongsTo(TaskCategoriesModel::class,'task_category_uuid');
    }
}
