<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-05
 * Time: 04:05
 */

namespace App\Services;


use App\Repositories\Contracts\IPositionRepository;
use App\Services\Response\ServiceResponseDto;

class PositionService extends BaseService
{
    protected $positionRepository;

    public function __construct(IPositionRepository $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    protected function isPositionExist($positionName,$positionId,$id= null){
        $response = new ServiceResponseDto();

        $response->setResult($this->positionRepository->isPositionExist($positionName,$positionId,$id));

        return $response;
    }

    public function create($input){
        $response = new ServiceResponseDto();
        $isPositionExist = $this->isPositionExist($input['positionName'],$input['positionId'])->getResult();

        if($isPositionExist){
            $message = 'Jabatan sudah ada dalam data';
            $response->addErrorMessage($message);
        }else{
            try{
                $this->positionRepository->create($input);
            }catch (\Exception $exception){
                $message = $exception->getMessage();
                $response->addErrorMessage($message);
            }
        }

        return $response;
    }

    public function read($id){
        return $this->readObject($this->positionRepository,$id);
    }

    public function showAll(){
        return $this->getAllObject($this->positionRepository);
    }

    public function update($input){
        $response = new ServiceResponseDto();
        $isPositionExist = $this->isPositionExist($input['positionName'],$input['positionId'])->getResult();

        if($isPositionExist){
            $message = 'Jabatan sudah ada dalam data';
            $response->addErrorMessage($message);
        }else{
            try{
                $this->positionRepository->update($input);
            }catch (\Exception $exception){
                $message = $exception->getMessage();
                $response->addErrorMessage($message);
            }
        }

        return $response;
    }

    public function delete($id){
        return $this->deleteObject($this->positionRepository,$id);
    }

    public function pagination(){
        $response = new ServiceResponseDto();
        $data = [];

        try{
            $positions = $this->positionRepository->showAll();
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        foreach ($positions as $position) {
            $data[]=[
                'id'=>$position['id'],
                'positionId'=>$position['positionId'],
                'positionName'=>$position['positionName'],
                'isActive'=>$position['isActive']
            ];
        }
        $response->setResult($data);

        return $response;
    }

}