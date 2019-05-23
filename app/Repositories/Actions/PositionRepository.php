<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-05
 * Time: 03:55
 */

namespace App\Repositories\Actions;


use App\Models\PositionModel;
use App\Repositories\Contracts\IPositionRepository;

class PositionRepository implements IPositionRepository
{

    public function create($input)
    {
        $position = new PositionModel();
        $position->position_id = $input['positionId'];
        $position->position_name = $input['positionName'];
        $position->is_active = $input['isActive'];
        $position->created_at = date('Y-m-d H:i:s');

        return $position->save();
    }

    public function update($input)
    {
        $position = PositionModel::find($input['id']);
        $position->position_id = $input['positionId'];
        $position->position_name = $input['positionName'];
        $position->is_active = $input['isActive'];
        $position->created_at = date('Y-m-d H:i:s');

        return $position->save();
    }

    public function delete($id)
    {
        return PositionModel::find($id)->delete();
    }

    public function read($id)
    {
        $result = PositionModel::find($id);

        return [
            'id'=>$result->id,
            'positionId'=>$result->position_id,
            'positionName'=>$result->position_name,
            'isActive'=>$result->is_active,
            'createdAt'=>$result->created_at->toDateString(),
            'updatedAt'=>$result->updated_at->toDateString(),
        ];
    }

    public function showAll()
    {
        $positions = PositionModel::all();
        $data = [];

        foreach ($positions as $position) {
            $data[]=[
                'id'=>$position->id,
                'positionId'=>$position->position_id,
                'positionName'=>$position->position_name,
                'isActive'=>$position->is_active,
                'createdAt'=>$position->created_at->toDateString(),
                'updatedAt'=>$position->updated_at->toDateString(),
            ];
        }

        return $data;
    }

    public function pagination($searchPhrase = null)
    {
        $query = PositionModel::query();
        $query->orderBy('id','asc');

        if($searchPhrase != null){
            $query->where('position_name','=',$searchPhrase);
        }

        return $query->paginate(10);
    }

    public function isPositionExist($positionName, $positionId)
    {
        $result = PositionModel::where('position_id','=',$positionId)->where('position_name','=',$positionName)->count();


        return ($result >0);
    }

    public function getLimitParticipant($id)
    {
        $result = PositionModel::where('id','=',$id)->value('limit_participant');

        return $result;
    }

    public function getPositionName($id)
    {
        $result = PositionModel::where('id','=',$id)->value('position_name');

        return $result;
    }

    public function getPositionId($id)
    {
        return PositionModel::where('id','=',$id)->value('position_id');
    }


}