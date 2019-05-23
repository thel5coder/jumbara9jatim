<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-05-05
 * Time: 07:43
 */

namespace App\Repositories\Actions;


use App\Models\TaskCategoriesModel;
use App\Repositories\Contracts\ITaskCategoriesRepository;

class TaskCategoriesRepository implements ITaskCategoriesRepository
{

    public function create($input)
    {
        $taskCategories = new TaskCategoriesModel();
        $taskCategories->category_name = $input['categoryName'];
        $taskCategories->created_at = date('Y-m-d H:i:s');

        return $taskCategories->save();
    }

    public function update($input)
    {
        return TaskCategoriesModel::uuid($input['uuid'])
            ->update([
                'category_name'=>$input['categoryName'],
                'updated_at'=>date('Y-m-d')
            ]);
    }

    public function delete($id)
    {
        return TaskCategoriesModel::uuid($id)->delete();
    }

    public function read($id)
    {
        $taskCategory = TaskCategoriesModel::uuid($id);

        return [
            'uuid'=>$taskCategory->uuid,
            'categoryName'=>$taskCategory->category_name
        ];
    }

    public function showAll()
    {
        $tasksCategories = TaskCategoriesModel::all();
        $data = [];

        foreach($tasksCategories as $tasksCategory){
            $data[]=[
                'uuid'=>$tasksCategory->uuid,
                'categoryName'=>$tasksCategory->category_name
            ];
        }

        return $data;
    }

    public function pagination($searchPhrase = null)
    {
        // TODO: Implement pagination() method.
    }

    public function isCategoryNameExist($categoryName, $uuid = null)
    {
        $query = TaskCategoriesModel::query();

        $query->where('category_name','=',$categoryName);
        if($uuid != null){
            $query->where('uuid','<>',$uuid);
        }

        return ($query->count() > 0);
    }


}