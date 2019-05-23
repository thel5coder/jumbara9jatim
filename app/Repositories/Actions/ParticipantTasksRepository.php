<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-05-22
 * Time: 04:05
 */

namespace App\Repositories\Actions;


use App\Models\ParticipantModel;
use App\Models\ParticipantTasksModel;
use App\Repositories\Contracts\IParticipantTasksRepository;

class ParticipantTasksRepository implements IParticipantTasksRepository
{

    public function create($input)
    {
        $participantTask = new ParticipantTasksModel();
        $participantTask->participant_id = $input['participantId'];
        $participantTask->task_uuid = $input['taskUuid'];
        $participantTask->contingent_id = $input['contingentId'];

        return $participantTask->save();
    }

    public function update($input)
    {
        return ParticipantTasksModel::where('participant_id','=',$input['participantId'])
            ->where('task_uuid','=',$input['taskUuid'])
            ->update(['task_uuid'=>$input['taskUuid']]);
    }

    public function delete($id)
    {
        return null;
    }

    public function read($id)
    {
        // TODO: Implement read() method.
    }

    public function showAll()
    {
        // TODO: Implement showAll() method.
    }

    public function pagination($searchPhrase = null)
    {
        // TODO: Implement pagination() method.
    }

    public function getParticipantTasksByContingent($contingentId)
    {
        $participants = ParticipantModel::join('position','position.id','=','participant.position_id')
            ->select('participant.id','participant.participant_id','participant.participant_number','participant.contingent_id','participant.position_id','participant.full_name','participant.mis','position.position_name')
            ->where('participant.contingent_id','=',$contingentId)
            ->whereNotIn('participant.position_id',[46,47])
            ->get();
        $data =[];
        $assigments['assigment1']='56a80dc7-21d5-4fe2-b5a2-44fa3f7b4b4c';
        $assigments['assigment2']='8a494b8e-4181-4b8d-ada8-2fb5b2cbd2b0';
        $assigments['assigment3'] = null;
        $assigments['assigment4'] = null;
        $assigments['assigment5'] = null;
        $assigments['assigment6'] = null;
        $assigments['assigment7'] = null;

        foreach($participants as $participant){
            $participantId = $participant->participant_id;
            $participantTasks = ParticipantTasksModel::where('participant_id','=',$participantId)->get();

            if(count($participantTasks)>0){
                for($i= 2;$i<=count($participantTasks);$i++){
                    $assigments['assigment'.($i+1)] = $participantTasks[$i]->task_uuid;
                }
            }else{
                for($i=2;$i<=6;$i++){
                    $assigments['assigment'.($i+1)] = null;
                }
            }

            $data[]=[
                'id'=>$participant->id,
                'contingentId'=>$participant->contingent_id,
                'fullName'=>$participant->full_name,
                'participantId'=>$participant->participant_id.''.$participant->participant_number,
                'positionName'=>$participant->position_name,
                'assigments'=>$assigments,
            ];
        }

        return $data;
    }

    public function deleteTask($participantId, $taskUuid)
    {
        return ParticipantTasksModel::whereNotIn('participant_id',$participantId)
            ->whereNotIn('task_uuid',$taskUuid)
            ->delete();
    }


}