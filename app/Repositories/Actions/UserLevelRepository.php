<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-22
 * Time: 09:21
 */

namespace App\Repositories\Actions;


use App\Models\UserLevelModel;
use App\Repositories\Contracts\IUserLevelRepository;

class UserLevelRepository implements IUserLevelRepository
{

    public function create($input)
    {
        $userLevel = new UserLevelModel();
        $userLevel->level_name = $input['levelName'];
        $userLevel->is_active = $input['isActive'];
        $userLevel->created_at = date('Y-m-d H:i:s');

        $userLevel->save();
    }

    public function update($input)
    {
        $userLevel = UserLevelModel::find($input['id']);
        $userLevel->level_name = $input['levelName'];
        $userLevel->is_active = $input['isActive'];
        $userLevel->updated_at = date('Y-m-d H:i:s');

        $userLevel->save();
    }

    public function delete($id)
    {
        return UserLevelModel::find($id)->delete();
    }

    public function read($id)
    {
        $userLevel = UserLevelModel::find($id);

        return [
            'id'=>$userLevel->id,
            'levelName'=>$userLevel->level_name,
            'isActive'=>($userLevel->is_active==1 ? true:false),
            'createdAt'=>$userLevel->created_at->toDateString(),
            'updatedAt'=>$userLevel->updated_at->toDateString()
        ];
    }

    public function showAll()
    {
        $userLevels = UserLevelModel::all();
        $data = [];

        foreach ($userLevels as $userLevel){
            $data[]=[
                'id'=>$userLevel->id,
                'levelName'=>$userLevel->level_name,
                'isActive'=>($userLevel->is_active==1 ? true:false),
                'createdAt'=>$userLevel->created_at->toDateString(),
                'updatedAt'=>$userLevel->updated_at->toDateString()
            ];
        }

        return $data;
    }

    public function pagination($searchPhrase = null)
    {
        // TODO: Implement pagination() method.
    }

    public function isUserLevelExist($levelName, $id = null)
    {
        $query = UserLevelModel::query();

        $query->where('level_name','=',$levelName);

        if($id != null)
            $query->where('id','<>',$id);

        return ($query->count() > 0);
    }
}