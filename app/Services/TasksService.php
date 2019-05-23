<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-05-20
 * Time: 19:02
 */

namespace App\Services;


use App\Repositories\Contracts\ITasksRepository;
use App\Services\Response\ServiceResponseDto;

class TasksService extends BaseService
{
    protected $taskRepository;

    public function __construct(ITasksRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    protected function isTaskExist($taskTitle,$uuid = null){
        $response = new ServiceResponseDto();

        $response->setResult($this->taskRepository->isTaskExist($taskTitle,$uuid));

        return $response;
    }

    public function create($input){
        $response = new ServiceResponseDto();
        $isTaskExist = $this->isTaskExist($input['taskTitle'])->getResult();

        if($isTaskExist){
            $response->addErrorMessage('Bidang kegiatan sudah ada dalam data');
        }else{
            try{
                $this->taskRepository->create($input);
            }catch (\Exception $exception){
                $response->addErrorMessage($exception->getMessage());
            }
        }

        return $response;
    }

    public function read($id){
        return $this->readObject($this->taskRepository,$id);
    }

    public function showAll(){
        return $this->getAllObject($this->taskRepository);
    }

    public function update($input,$uuid){
        $response = new ServiceResponseDto();
        $isTaskExist = $this->isTaskExist($input['taskTitle'],$uuid)->getResult();

        if($isTaskExist){
            $response->addErrorMessage('Bidang kegiatan sudah ada dalam data');
        }else{
            try{
                $input['uuid'] = $uuid;
                $this->taskRepository->update($input);
            }catch (\Exception $exception){
                $response->addErrorMessage($exception->getMessage());
            }
        }

        return $response;
    }

    public function delete($id){
        return $this->deleteObject($this->taskRepository,$id);
    }

    public function getValuationTaskNonMasal(){
        $response = new ServiceResponseDto();

        $response->setResult($this->taskRepository->getValuationTaskNonMasal());

        return $response;
    }
}