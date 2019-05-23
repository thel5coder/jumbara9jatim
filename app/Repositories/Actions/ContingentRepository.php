<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-08
 * Time: 02:59
 */

namespace App\Repositories\Actions;


use App\Models\ContingentModel;
use App\Repositories\Contracts\IContingentRepository;

class ContingentRepository implements IContingentRepository
{

    public function create($input)
    {
        $contingent = new ContingentModel();
        $contingent->contingent_id = $input['contingentId'];
        $contingent->contingent_name = $input['contingentName'];
        $contingent->is_active = $input['isActive'];
        $contingent->created_at = date('Y-m-d H:i:s');

        return $contingent->save();
    }

    public function update($input)
    {
        $contingent = ContingentModel::find($input['id']);
        $contingent->contingent_id = $input['contingentId'];
        $contingent->contingent_name = $input['contingentName'];
        $contingent->is_active = $input['isActive'];
        $contingent->updated_at = date('Y-m-d H:i:s');

        return $contingent->save();
    }

    public function delete($id)
    {
        return ContingentModel::find($id)->delete();
    }

    public function read($id)
    {
        $contingent = ContingentModel::find($id);

        return [
            'id'=>$contingent->id,
            'contingentId'=>$contingent->contingent_id,
            'contingentName'=>$contingent->contingent_name,
            'isActive'=>$contingent->is_active,
            'created_at'=>$contingent->created_at->toDateString(),
            'updated_at'=>$contingent->updated_at->toDateString()
        ];
    }

    public function showAll()
    {
        $contingents = ContingentModel::all();
        $data = [];

        foreach($contingents as $contingent){
            $data[]=[
                'id'=>$contingent->id,
                'contingentId'=>$contingent->contingent_id,
                'contingentName'=>$contingent->contingent_name,
                'isActive'=>$contingent->is_active,
                'created_at'=>$contingent->created_at->toDateString(),
                'updated_at'=>$contingent->updated_at->toDateString()
            ];
        }

        return $data;
    }

    public function pagination($searchPhrase = null)
    {
        // TODO: Implement pagination() method.
    }

    public function isContingentExist($contingentId, $contingentName,$id = null)
    {
        $query = ContingentModel::query();

        $query->where('contingent_id','=',$contingentId)->where('contingent_name','=',$contingentName);
        if($id != null){
            $query->where('id','<>',$id);
        }

        return ($query->count()>0);
    }

    public function getContingentId($id)
    {
        return ContingentModel::where('id','=',$id)->value('contingent_id');
    }


}