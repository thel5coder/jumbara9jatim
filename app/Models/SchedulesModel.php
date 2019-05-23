<?php

namespace App\Models;

use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Model;

class SchedulesModel extends Model
{
    use Uuids;

    protected $table = 'schedules';
    public $incrementing = false;
    protected $primaryKey = 'uuid';
    public $timestamps = false;

    public function tasks(){
        return $this->hasOne(TaskModel::class,'schedule_uuid','uuid');
    }
}
