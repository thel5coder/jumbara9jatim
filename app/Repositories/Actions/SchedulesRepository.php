<?php

namespace App\Repositories\Actions;


use App\Models\SchedulesModel;
use App\Models\TaskCategoriesModel;
use App\Models\TaskModel;
use App\Repositories\Contracts\ISchedulesRepository;

class SchedulesRepository implements ISchedulesRepository
{

    public function create($input)
    {
        $schedule = new SchedulesModel();
        $schedule->task_uuid = $input['taskUuid'];
        $schedule->schedule_time_start = $input['scheduleTimeStart'];
        $schedule->schedule_time_finish = $input['scheduleTimeFinish'];
        $schedule->schedule_date = $input['scheduleDate'];
        $schedule->schedule_integer_start = $input['scheduleIntegerStart'];
        $schedule->schedule_integer_finish = $input['scheduleIntegerFinish'];
        $schedule->pic = $input['pic'];

        $schedule->save();
    }

    public function update($input)
    {
        $schedule = SchedulesModel::find($input['uuid']);
        $schedule->schedule_time_start = $input['scheduleTimeStart'];
        $schedule->schedule_time_finish = $input['scheduleTimeFinish'];
        $schedule->schedule_date = $input['scheduleDate'];
        $schedule->schedule_integer_start = $input['scheduleIntegerStart'];
        $schedule->schedule_integer_finish = $input['scheduleIntegerFinish'];
        $schedule->pic = $input['pic'];

        $schedule->save();
    }

    public function delete($id)
    {
       return SchedulesModel::uuid($id)->delete();
    }

    public function read($id)
    {
        $schedule = SchedulesModel::uuid($id);
        $data = [
            'uuid'=>$schedule->uuid,
            'taskUuid' =>$schedule->task_uuid,
            'scheduleDate' => $schedule->schedule_date,
            'scheduleTimeStart' => $schedule->schedule_time_start,
            'scheduleTimeFinish' => $schedule->schedule_time_finish,
            'scheduleIntegerStart' => $schedule->schedule_integer_start,
            'scheduleIntegerFinish' =>$schedule->schedule_integer_finish,
            'pic'=>$schedule->pic
        ];


        return $data;
    }

    public function showAll()
    {
        $schedules = SchedulesModel::join('tasks','tasks.uuid','=','schedules.task_uuid')
            ->select('schedules.*','tasks.task_title')
            ->get();
        $data =[];

        foreach($schedules as $schedule){
            $data[]=[
                'uuid'=>$schedule->uuid,
                'taskUuid' =>$schedule->task_uuid,
                'taskTitle'=>$schedule->task_title,
                'scheduleDate' => $schedule->schedule_date,
                'scheduleTimeStart' => $schedule->schedule_time_start,
                'scheduleTimeFinish' => $schedule->schedule_time_finish,
                'scheduleIntegerStart' => $schedule->schedule_integer_start,
                'scheduleIntegerFinish' => $schedule->schedule_integer_finish,
                'pic'=>$schedule->pic
            ];
        }

        return $data;
    }

    public function pagination($searchPhrase = null)
    {
        // TODO: Implement pagination() method.
    }

    public function isScheduleExist($taskUuid,$date,$scheduleTime,$uuid = null)
    {
        $query = SchedulesModel::query();

        $query->where(function ($q)use($taskUuid,$date,$scheduleTime){
            $q->where('task_uuid','=',$taskUuid)
                ->where('schedule_date','=',$date)
                ->where('schedule_time_start','=',$scheduleTime);
        });
        if(!$uuid == null){
            $query->where('uuid','<>',$uuid);
        }

        return ($query->count()>0);
    }

    public function getScheduleValuationAll()
    {
        $schedules = SchedulesModel::join('tasks','tasks.uuid','=','schedules.task_uuid')
            ->select('schedules.uuid','schedules.task_uuid','tasks.task_title','tasks.is_valuation')
            ->where('tasks.is_valuation','=',1)
            ->get();

        $data = [];

        foreach ($schedules as $schedule){
            $data[]=[
                'taskTitle'=>$schedule->task_title,
                'taskUuid'=>$schedule->task_uuid
            ];
        }

        return $data;
    }

    public function getScheduleValuationFiltered($taskCategoryUuid,$scheduleDate,$scheduleTime)
    {
        $schedules = SchedulesModel::join('tasks','tasks.uuid','=','schedules.task_uuid')
            ->select('schedules.uuid','schedules.task_uuid','tasks.is_valuation')
            ->where('tasks.is_valuation','=',1)
            ->where(function ($q)use($scheduleDate,$scheduleTime){
                $q->where('schedule_date','<>',$scheduleDate)
                    ->where('schedule_time_start','<>',$scheduleTime);
            })
            ->get();

        $data = [];

        foreach ($schedules as $schedule){
            $data[]=[
                'taskTitle'=>$schedule->task_title,
                'uuid'=>$schedule->uuid
            ];
        }

        return $data;
    }


}