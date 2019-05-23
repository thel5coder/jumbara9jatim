<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-05-22
 * Time: 04:19
 */

namespace App\Services;


use App\Repositories\Contracts\IParticipantTasksRepository;
use App\Services\Response\ServiceResponseDto;

class ParticipantTasksService extends BaseService
{
    protected $participantTasksRepository;

    public  function __construct(IParticipantTasksRepository $participantTasksRepository)
    {
        $this->participantTasksRepository = $participantTasksRepository;
    }

    public function create($input){
        $response = new ServiceResponseDto();

        try{
            $participantTasks = $input['participantTasks'];
            foreach ($participantTasks as $participantTask){
                $param = [
                    'contingentId'=>$input['contingentId'],
                    'participantId'=>$participantTask->participantId,
                    'taskUuid'=>$participantTask->taskUuid
                ];
                $this->participantTasksRepository->create($param);
            }
        }catch (\Exception $exception){
            $response->addErrorMessage($exception->getMessage());
        }

        return $response;
    }

    public function getParticipantTaskByContingent($contingentId){
        $response = new ServiceResponseDto();

        $response->setResult($this->participantTasksRepository->getParticipantTasksByContingent($contingentId));

        return $response;
    }

}