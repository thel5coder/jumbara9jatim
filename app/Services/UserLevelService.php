<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-22
 * Time: 09:35
 */

namespace App\Services;


use App\Repositories\Contracts\IUserLevelRepository;
use App\Services\Response\ServiceResponseDto;

class UserLevelService extends BaseService
{

    protected $userLevelRepository;

    public function __construct(IUserLevelRepository $userLevelRepository)
    {
        $this->userLevelRepository = $userLevelRepository;
    }

    protected function isUserLevelExist($levelName,$id = null){
        $response = new ServiceResponseDto();

        $response->setResult($this->userLevelRepository->isUserLevelExist($levelName,$id));

        return $response;
    }

    public function create($input){
        $response = new ServiceResponseDto();
        $isLevelExist = $this->isUserLevelExist($input['levelName'])->getResult();

        if($isLevelExist){
            $message = 'Level pengguna sudah ada';
            $response->addErrorMessage($message);
        }else{
            try{
                $this->userLevelRepository->create($input);
            }catch (\Exception $exception){
                $message = $exception->getMessage();
                $response->addErrorMessage($message);
            }
        }

        return $response;
    }

    public function read($id){
        return $this->readObject($this->userLevelRepository,$id);
    }

    public function showAll(){
        return $this->getAllObject($this->userLevelRepository);
    }

    public function update($input){
        $response = new ServiceResponseDto();
        $isLevelExist = $this->isUserLevelExist($input['levelName'],$input['id'])->getResult();

        if($isLevelExist){
            $message = 'Level pengguna sudah ada';
            $response->addErrorMessage($message);
        }else{
            try{
                $this->userLevelRepository->update($input);
            }catch (\Exception $exception){
                $message = $exception->getMessage();
                $response->addErrorMessage($message);
            }
        }

        return $response;
    }

    public function delete($id){
        return $this->deleteObject($this->userLevelRepository,$id);
    }
}