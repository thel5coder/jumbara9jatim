<?php

namespace App\Models;

use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Model;

class ParticipantTasksModel extends Model
{
    use Uuids;

    protected $table = 'participant_tasks';
    public $incrementing = false;
    protected $primaryKey = 'uuid';
}
