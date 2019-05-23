<?php

namespace App\Repositories\Actions;


use App\Models\User;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\Contracts\Pagination\PaginationParam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    public function create($input)
    {
        $user = new User();
        $user->user_name = $input['userName'];
        $user->password = bcrypt($input['password']);
        $user->user_level_id = $input['userLevelId'];
        $user->contingent_id = $input['contingentId'];
        $user->created_at = date('Y-m-d H:i:s');

        return $user->save();
    }

    public function update($input)
    {
        $user = User::find($input['id']);
        $user->user_name = $input['userName'];
        $user->user_level_id = $input['userLevelId'];
        $user->contingent_id = $input['contingentId'];
        $user->updated_at = date('Y-m-d H:i:s');

        return $user->save();
    }

    public function updateProfileUserContingent($input)
    {
        $user = User::find($input['userId']);
        $user->branch_addres = $input['branchAddress'];
        $user->branch_phone = $input['branchPhone'];
        $user->pic_1 = $input['pic1'];
        $user->pic_2 = $input['pic2'];
        $user->pic1_phone = $input['pic1Phone'];
        $user->pic2_phone = $input['pic2phone'];
        $user->updated_at = date('Y-m-d H:i:s');

        return $user->save();
    }


    public function delete($id)
    {
        return User::find($id)->delete();
    }

    public function read($id)
    {
       $user =  User::join('user_level','user_level.id','=','users.user_level_id')
           ->leftJoin('contingent','contingent.id','=','users.contingent_id')
           ->select('users.*','user_level.level_name','contingent.contingent_name')
           ->where('users.id','=',$id)
           ->first();

       return [
           'id'=>$user->id,
           'contingentId'=>$user->contingent_id,
           'userLevelId'=>$user->user_level_id,
           'userName'=>$user->user_name,
           'userLevel'=>$user->level_name,
           'contingent'=>$user->contingent_name,
           'branchAddress'=>$user->branch_address,
           'branchPhone'=>$user->branch_phone,
           'pic1Name'=>$user->pic_1,
           'pic2Name'=>$user->pic_2,
           'pic1Phone'=>$user->pic1_phone,
           'pic2Phone'=>$user->pic2_phone,
           'isActive'=>$user->is_active,
           'createdAt'=>$user->created_at->toDateString(),
           'updatedAt'=>$user->updated_at->toDateString(),
       ];
    }

    public function showAll()
    {
        $users =  User::join('user_level','user_level.id','=','users.user_level_id')
            ->leftJoin('contingent','contingent.id','=','users.contingent_id')
            ->select('users.*','user_level.level_name','contingent.contingent_name')
            ->get();

        $data = [];
        foreach ($users as $user){
            $data[]=[
                'id'=> $user->id,
                'contingentId'=> $user->contingent_id,
                'userLevelId'=>$user->user_level_id,
                'userName'=> $user->user_name,
                'userLevel'=> $user->level_name,
                'contingent'=> $user->contingent_name,
                'branchAddress'=> $user->branch_address,
                'branchPhone'=> $user->branch_phone,
                'pic1Name'=> $user->pic_1,
                'pic2Name'=> $user->pic_2,
                'pic1Phone'=> $user->pic1_phone,
                'pic2Phone'=> $user->pic2_phone,
                'isActive'=> $user->is_active
            ];
        }

        return $data;
    }


    public function pagination($searchPhrase = null)
    {
        $query = User::query();

        $query->join('user_level','user_level.id','=','users.user_level_id')
            ->select('users.*','user_level.level_name');

        if($searchPhrase == null){
            $query->orderBy('id','asc');
        }else{
            $query->orderBy('id','asc')
                ->where('users.name','like',$searchPhrase.'%')
                ->orWhere('users.user_name','like',$searchPhrase.'%')
                ->orWhere('user_level.level_name','like',$searchPhrase.'%');
        }

        return $query->paginate(10);
    }

    public function isUserNameExist($userName, $id = null)
    {
        $query = User::query();

        $query->where('user_name','=',$userName);
        if($id != null){
           $query->where('id','<>',$id);
        }

        return ($query->count() > 0);
    }

    public function changePassword($userName, $password)
    {
        return User::where('user_name','=',$userName)->update(['password'=>bcrypt($password)]);
    }


}
