<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-08
 * Time: 03:07
 */

namespace App\Services;


use App\Repositories\Contracts\IContingentRepository;
use App\Services\Response\ServiceResponseDto;

class ContingentService extends BaseService
{
    protected $contingentRepository;

    public function __construct(IContingentRepository $continentRepository)
    {
        $this->contingentRepository = $continentRepository;
    }

    protected function isContingentExist($contingentId,$contingentName,$id = null){
        $response = new ServiceResponseDto();

        $response->setResult($this->contingentRepository->isContingentExist($contingentId,$contingentName,$id));

        return $response;
    }

    public function create($input){
        $response = new ServiceResponseDto();
        $isContingentExist = $this->isContingentExist($input['contingentId'],$input['contingentName'])->getResult();

        if($isContingentExist){
            $message = 'Data kontingen yang anda masukkan sudah ada';
            $response->addErrorMessage($message);
        }else{
            try{
                $this->contingentRepository->create($input);
            }catch (\Exception $exception){
                $message= $exception->getMessage();
                $response->addErrorMessage($message);
            }
        }

        return $response;
    }

    public function read($id){
        return $this->readObject($this->contingentRepository,$id);
    }

    public function showAll(){
        return $this->getAllObject($this->contingentRepository);
    }

    public function update($input){
        $response = new ServiceResponseDto();
        $isContingentExist = $this->isContingentExist($input['contingentId'],$input['contingentName'],$input['id'])->getResult();

        if($isContingentExist){
            $message = 'Data kontingen yang anda masukkan sudah ada';
            $response->addErrorMessage($message);
        }else{
            try{
                $this->contingentRepository->update($input);
            }catch (\Exception $exception){
                $message= $exception->getMessage();
                $response->addErrorMessage($message);
            }
        }

        return $response;
    }

    public function delete($id){
        return $this->deleteObject($this->contingentRepository,$id);
    }

    public function pagination(){
        $response = new ServiceResponseDto();
        $data = [];

        try{
            $contingents = $this->contingentRepository->showAll();
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        foreach ($contingents as $contingent) {
            $data[]=[
                'id'=>$contingent['id'],
                'contingentId'=>$contingent['contingentId'],
                'contingentName'=>$contingent['contingentName'],
                'isActive'=>$contingent['isActive']
            ];
        }

        $response->setResult($data);

        return $response;
    }
}