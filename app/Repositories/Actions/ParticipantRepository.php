<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-08
 * Time: 04:52
 */

namespace App\Repositories\Actions;


use App\Models\ContingentModel;
use App\Models\ParticipantModel;
use App\Repositories\Contracts\IParticipantRepository;

class ParticipantRepository implements IParticipantRepository
{

    public function create($input)
    {
        $participant = new ParticipantModel();
        $participant->contingent_id = $input['contingentId'];
        $participant->participant_id = $input['participantId'];
        $participant->participant_number = $input['participantNumber'];
        $participant->mis = $input['mis'];
        $participant->full_name = $input['fullName'];
        $participant->birth_place = $input['birthPlace'];
        $participant->birth_date = $input['birthDate'];
        $participant->sex = $input['sex'];
        $participant->religion = $input['religion'];
        $participant->address = $input['address'];
        $participant->phone = $input['phone'];
        $participant->group_member = $input['groupMember'];
        $participant->position_id = $input['positionId'];
        $participant->email = $input['email'];
        $participant->photograph = $input['photograph'];
        $participant->ansurance = $input['ansurance'];
        $participant->mis_image = $input['misImage'];
        $participant->is_active = $input['isActive'];

        return $participant->save();

    }

    public function update($input)
    {
        $participant = ParticipantModel::find($input['id']);
        $participant->contingent_id = $input['contingentId'];
        $participant->participant_id = $input['participantId'];
        $participant->mis = $input['mis'];
        $participant->full_name = $input['fullName'];
        $participant->birth_place = $input['birthPlace'];
        $participant->birth_date = $input['birthDate'];
        $participant->sex = $input['sex'];
        $participant->religion = $input['religion'];
        $participant->address = $input['address'];
        $participant->phone = $input['phone'];
        $participant->group_member = $input['groupMember'];
        $participant->position_id = $input['positionId'];
        $participant->email = $input['email'];
        $participant->photograph = $input['photograph'];
        $participant->ansurance = $input['ansurance'];
        $participant->mis_image = $input['misImage'];
        $participant->is_active = $input['isActive'];

        return $participant->save();
    }

    public function delete($id)
    {
        return ParticipantModel::where('id','=',$id)->delete();
    }

    public function read($id)
    {
        $participant = ParticipantModel::join('contingent','contingent.id','=','participant.contingent_id')
            ->join('position','position.id','=','participant.position_id')
            ->select('participant.*','contingent.contingent_name','position.position_name')
            ->where('participant.id','=',$id)
            ->first();


        return [
            'id'=>$participant->id,
            'contingentName'=>$participant->contingent_name,
            'contingentId'=>$participant->contingent_id,
            'participantId'=>$participant->participant_id,
            'participantNumber'=>$participant->participant_number,
            'mis'=>$participant->mis,
            'fullName'=>$participant->full_name,
            'birthPlace'=>$participant->birth_place,
            'birthDate'=>$participant->birth_date,
            'sex'=>$participant->sex,
            'religion'=>$participant->religion,
            'address'=>$participant->address,
            'phone'=>$participant->phone,
            'groupMember'=>$participant->group_member,
            'positionName'=>$participant->position_name,
            'positionId'=>$participant->position_id,
            'email'=>$participant->email,
            'photograph'=>$participant->photograph,
            'ansurance'=>$participant->ansurance,
            'misImage'=>$participant->mis_image,
            'isActive'=>$participant->is_active
        ];
    }

    public function showAll()
    {
        $participants = ParticipantModel::join('contingent','contingent.id','=','participant.contingent_id')
            ->join('position','position.id','=','participant.position_id')
            ->select('participant.*','contingent.contingent_name','position.position_name')
            ->get();
        $data = [];

        foreach ($participants as $participant){
            $data[]=[
                'id'=>$participant->id,
                'contingentName'=>$participant->contingent_name,
                'contingentId'=>$participant->contingent_id,
                'participantId'=>$participant->participant_id,
                'participantNumber'=>$participant->participant_number,
                'mis'=>$participant->mis,
                'fullName'=>$participant->full_name,
                'birthPlace'=>$participant->birth_place,
                'birthDate'=>$participant->birth_date,
                'sex'=>$participant->sex,
                'religion'=>$participant->religion,
                'address'=>$participant->address,
                'phone'=>$participant->phone,
                'groupMember'=>$participant->group_member,
                'positionName'=>$participant->position_name,
                'positionId'=>$participant->position_id,
                'email'=>$participant->email,
                'photograph'=>$participant->photograph,
                'ansurance'=>$participant->ansurance,
                'misImage'=>$participant->mis_image,
                'isActive'=>$participant->is_active
            ];
        }

        return $data;
    }

    public function pagination($searchPhrase = null)
    {
        // TODO: Implement pagination() method.
    }

    public function getParticipantByContingent($contingentId)
    {
        $participants = ParticipantModel::join('contingent','contingent.id','=','participant.contingent_id')
            ->join('position','position.id','=','participant.position_id')
            ->select('participant.*','contingent.contingent_name','position.position_name')
            ->where('participant.contingent_id','=',$contingentId)
            ->get();

        $data = [];

        foreach ($participants as $participant){
            $data[]=[
                'id'=>$participant->id,
                'contingentName'=>$participant->contingent_name,
                'contingentId'=>$participant->contingent_id,
                'participantId'=>$participant->participant_id,
                'participantNumber'=>$participant->participant_number,
                'mis'=>$participant->mis,
                'fullName'=>$participant->full_name,
                'birthPlace'=>$participant->birth_place,
                'birthDate'=>$participant->birth_date,
                'sex'=>$participant->sex,
                'religion'=>$participant->religion,
                'address'=>$participant->address,
                'phone'=>$participant->phone,
                'groupMember'=>$participant->group_member,
                'positionName'=>$participant->position_name,
                'positionId'=>$participant->position_id,
                'email'=>$participant->email,
                'photograph'=>$participant->photograph,
                'ansurance'=>$participant->ansurance,
                'misImage'=>$participant->mis_image,
                'isActive'=>$participant->is_active
            ];
        }

        return $data;
    }

    public function isParticipantExist($mis, $id = null)
    {
        $query = ParticipantModel::query();

        $query->where('mis','=',$mis);
        if($id != null){
            $query->where('id','<>',$id);
        }

        return ($query->count()>0);
    }

    public function getCountParticipantByPositionPerContingent($contingentId, $positionId,$id = null)
    {
        $query = ParticipantModel::query();
        $query->where(function($q)use($contingentId,$positionId){
            $q->where('contingent_id','=',$contingentId)->where('position_id','=',$positionId);
        });

        if($id != null){
            $query->where('id','<>',$id);
        }

        return $query->count();
    }

    public function getCountParticipantByContingent($contingentId)
    {
        return ParticipantModel::where('contingent_id','=',$contingentId)->count();
    }

    public function changeDocument($documentType,$id)
    {
        $query = ParticipantModel::query();

        $query->where('id','=',$id);

        switch ($documentType){
            case "photograph":
                return $query->update([
                    'photograph'=>null
                ]);
                break;
            case "ansurance":
                return $query->update([
                    'ansurance'=>null
                ]);
                break;
            default:
                return $query->update([
                    'mis_image'=>null
                ]);
                break;
        }
    }

    public function getParticipantByGroup($group)
    {
        $participants = ParticipantModel::join('contingent','contingent.id','=','participant.contingent_id')
            ->join('position','position.id','=','participant.position_id')
            ->select('participant.*','contingent.contingent_name','position.position_name')
            ->where('participant.group_member','=',$group)
            ->get();

        $data = [];

        foreach ($participants as $participant){
            $data[]=[
                'id'=>$participant->id,
                'contingentName'=>$participant->contingent_name,
                'contingentId'=>$participant->contingent_id,
                'participantId'=>$participant->participant_id,
                'participantNumber'=>$participant->participant_number,
                'mis'=>$participant->mis,
                'fullName'=>$participant->full_name,
                'birthPlace'=>$participant->birth_place,
                'birthDate'=>$participant->birth_date,
                'sex'=>$participant->sex,
                'religion'=>$participant->religion,
                'address'=>$participant->address,
                'phone'=>$participant->phone,
                'groupMember'=>$participant->group_member,
                'positionName'=>$participant->position_name,
                'positionId'=>$participant->position_id,
                'email'=>$participant->email,
                'photograph'=>$participant->photograph,
                'ansurance'=>$participant->ansurance,
                'misImage'=>$participant->mis_image,
                'isActive'=>$participant->is_active
            ];
        }

        return $data;
    }

    public function participantStatisticSummary()
    {
        $all = ParticipantModel::count();
        $mula = ParticipantModel::where('position_id','=',17)->count();
        $madya = ParticipantModel::where('position_id','=',18)->count();
        $wira = ParticipantModel::where('position_id','=',19)->count();
        $contingent = ParticipantModel::distinct('contingent_id')->count('contingent_id');

        return ['mula'=> $mula,'madya'=>$madya,'wira'=>$wira,'contingent'=>$contingent,'participant'=>$all];

    }


}