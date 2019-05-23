<?php

namespace App\Services;


use App\Repositories\Contracts\ISchedulesRepository;
use App\Services\Response\ServiceResponseDto;

class SchedulesService extends BaseService
{
    protected $schedulesRepository;

    public function __construct(ISchedulesRepository $schedulesRepository)
    {
        $this->schedulesRepository = $schedulesRepository;
    }

    protected function isScheduleExist($taskUuid,$scheduleDate,$scheduleTime,$uuid = null){
        $response = new ServiceResponseDto();

        $response->setResult($this->schedulesRepository->isScheduleExist($taskUuid,$scheduleDate,$scheduleTime,$uuid));

        return $response;
    }

    public function create($input){
        $response = new ServiceResponseDto();
        $isScheduleExist = $this->isScheduleExist($input['taskUuid'],$input['scheduleDate'],$input['scheduleTimeStart'])->getResult();

        if($isScheduleExist){
            $message = 'Jadwal sudah ada dalam data';
            $response->addErrorMessage($message);
        }else{
            try{
                $this->schedulesRepository->create($input);
            }catch (\Exception $exception){
                $response->addErrorMessage($exception->getMessage());
            }
        }

        return $response;
    }

    public function read($id){
        return $this->readObject($this->schedulesRepository,$id);
    }

    public function showAll(){
        return $this->getAllObject($this->schedulesRepository);
    }

    public function update($input,$uuid){
        $response = new ServiceResponseDto();
        $isScheduleExist = $this->isScheduleExist($input['taskUuid'],$input['scheduleDate'],$input['scheduleTime'],$uuid)->getResult();

        if($isScheduleExist){
            $message = 'Jadwal sudah ada dalam data';
            $response->addErrorMessage($message);
        }else{
            try{
                $input['uuid'] = $uuid;
                $this->schedulesRepository->update($input);
            }catch (\Exception $exception){
                $response->addErrorMessage($exception->getMessage());
            }
        }

        return $response;
    }

    public function delete($id){
        return $this->deleteObject($this->schedulesRepository,$id);
    }

    public function getScheduleValuationAll(){
        $response = new ServiceResponseDto();

        $response->setResult($this->schedulesRepository->getScheduleValuationAll());

        return $response;
    }

}