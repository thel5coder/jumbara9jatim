<?php

namespace App\Models;

use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Model;

class TaskCategoriesModel extends Model
{
    use Uuids;

    protected $table = 'task_categories';
    public $incrementing = false;
    protected $fillable = ['category_name'];
    protected $primaryKey = 'uuid';

    public function tasks(){
        return $this->hasMany(TaskModel::class,'task_category_uuid','uuid');
    }
}
