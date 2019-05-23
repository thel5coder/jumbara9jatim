<?php
/**
 * Created by PhpStorm.
 * User: syaikhul
 * Date: 05/03/2018
 * Time: 18.01
 */

namespace App\Services;


use App\Events\NewUserActivation;
use App\Events\NewUserFromBackOffice;
use App\Events\NewUserRegister;
use App\Repositories\Contracts\IUserRepository;
use App\Services\Response\ServicePaginationResponseDto;
use App\Services\Response\ServiceResponseDto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService extends BaseService
{
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    protected function isUserNameExist($userName,$id = null){
        $response = new ServiceResponseDto();

        $response->setResult($this->userRepository->isUserNameExist($userName,$id));

        return $response;
    }

    public function create($input){
        $response = new ServiceResponseDto();
        $isUserNameExist = $this->isUserNameExist($input['userName'])->getResult();

        if($isUserNameExist){
            $message= 'Username Sudah Ada,gunakan username yang lain';
            $response->addErrorMessage($message);
        }else{
            try{
                $this->userRepository->create($input);
            }catch (\Exception $exception){
                $message = $exception->getMessage();
                $response->addErrorMessage($message);
            }
        }

        return $response;
    }

    public function read($id){
        return $this->readObject($this->userRepository,$id);
    }

    public function showAll(){
        return $this->getAllObject($this->userRepository);
    }

    public function update($input){
        $response = new ServiceResponseDto();
        $isUserNameExist = $this->isUserNameExist($input['userName'],$input['id'])->getResult();

        if($isUserNameExist){
            $message= 'Username Sudah Ada,gunakan username yang lain';
            $response->addErrorMessage($message);
        }else{
            try{
                $this->userRepository->update($input);
            }catch (\Exception $exception){
                $message = $exception->getMessage();
                $response->addErrorMessage($message);
            }

        }

        return $response;
    }


    public function updateProfile($input){
        $response = new ServiceResponseDto();

        try{
            $this->userRepository->updateProfileUserContingent($input);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function delete($id){
        return $this->deleteObject($this->userRepository,$id);
    }

    public function paginationByUserLevel($param,$userLevel){
        $response = new ServicePaginationResponseDto();

        $pagingResult = $this->userRepository->paginationByUserLevel($this->parsePaginationParam($param), $userLevel);
        $response->setCurrentPage($param['pageIndex']);
        $response->setPageSize($param['pageSize']);
        $response->setTotalCount($pagingResult->getTotalCount());
        $response->setResult($pagingResult->getResult());

        return $response;
    }


    public function changePassword($userName,$password){
        $response = new ServiceResponseDto();

        try{
            $this->userRepository->changePassword($userName,$password);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function checkLogin($userName,$password){
        $response = new ServiceResponseDto();


        if (!$token = JWTAuth::attempt(['user_name'=>$userName,'password'=>$password])) {
            $message ='Username & kata sandi tidak sesuai';
            $response->addErrorMessage($message);
        }else{
            $response->setResult($token);
        }


        return $response;
    }
}
