<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-05-20
 * Time: 18:52
 */

namespace App\Repositories\Actions;


use App\Models\TaskModel;
use App\Repositories\Contracts\ITasksRepository;
use App\Services\DownloadService;

class TasksRepository implements ITasksRepository
{

    public function create($input)
    {
        $task = new TaskModel();
        $task->task_title = $input['taskTitle'];
        $task->task_category_uuid = $input['taskCategoryUuid'];
        $task->is_valuation = $input['isValuation'];

        return $task->save();
    }

    public function update($input)
    {
        $task = TaskModel::uuid($input['uuid']);
        $task->task_title = $input['taskTitle'];
        $task->task_category_uuid = $input['taskCategoryUuid'];
        $task->is_valuation = $input['isValuation'];

        return $task->save();
    }

    public function delete($id)
    {
        return TaskModel::uuid($id)->delete();
    }

    public function read($id)
    {
        $task = TaskModel::uuid($id);

        return [
            'uuid'=>$task->uuid,
            'taskCategoryUuid'=>$task->task_category_uuid,
            'taskTitle'=>$task->task_title,
            'isValuation'=>$task->is_valuation
        ];
    }

    public function showAll()
    {
        $tasks = TaskModel::join('task_categories','task_categories.uuid','=','tasks.task_category_uuid')
            ->select('tasks.*','task_categories.category_name')
            ->get();
        $data=[];

        foreach ($tasks as $task){
            $data[]=[
                'uuid'=>$task->uuid,
                'taskCategoryUuid'=>$task->task_category_uuid,
                'categoryName'=>$task->category_name,
                'taskTitle'=>$task->task_title,
                'isValuation'=>$task->is_valuation
            ];
        }

        return $data;
    }

    public function pagination($searchPhrase = null)
    {
        // TODO: Implement pagination() method.
    }

    public function isTaskExist($taskTitle, $uuid = null)
    {
        $query = TaskModel::query();
        $query->where('task_title','=',$taskTitle);

        if($uuid != null){
            $query->where('uuid','<>',$uuid);
        }

        return ($query->count() > 0);
    }

    public function getValuationTask()
    {
        $schedules = TaskModel::where('tasks.is_valuation','=',1)
            ->where('task_type','=','masal')
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

    public function getValuationTaskNonMasal()
    {
        $schedules = TaskModel::where('tasks.is_valuation','=',1)
            ->where('task_type','=','non masal')
            ->get();

        $data = [];

        foreach ($schedules as $schedule){
            $data[]=[
                'taskTitle'=>$schedule->task_title,
                'taskUuid'=>$schedule->uuid
            ];
        }

        return $data;
    }


}