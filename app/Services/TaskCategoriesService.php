<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-05-05
 * Time: 16:33
 */

namespace App\Services;


use App\Repositories\Contracts\ITaskCategoriesRepository;
use App\Services\Response\ServiceResponseDto;

class TaskCategoriesService extends BaseService
{

    protected $taskCategoriesRepository;

    public function __construct(ITaskCategoriesRepository $taskCategoriesRepository)
    {
        $this->taskCategoriesRepository = $taskCategoriesRepository;
    }

    protected function isCategoryNameExist($categoryName,$uuid = null){
        $response = new ServiceResponseDto();

        $response->setResult($this->taskCategoriesRepository->isCategoryNameExist($categoryName,$uuid));

        return $response;
    }

    public function create($input){
        $response = new ServiceResponseDto();
        $isCategoryNameExist = $this->isCategoryNameExist($input['categoryName'])->getResult();

        if($isCategoryNameExist){
            $message = 'Nama kategori tugas sudah ada';
            $response->addErrorMessage($message);
        }else{
            try{
                $this->taskCategoriesRepository->create($input);
            }catch (\Exception $exception){
                $response->addErrorMessage($exception->getMessage());
            }
        }

        return $response;
    }

    public function read($id){
        return $this->readObject($this->taskCategoriesRepository,$id);
    }

    public function showAll(){
        return $this->getAllObject($this->taskCategoriesRepository);
    }

    public function update($input,$id){
        $response = new ServiceResponseDto();
        $isCategoryNameExist = $this->isCategoryNameExist($input['categoryName'],$id)->getResult();

        if($isCategoryNameExist){
            $message = 'Nama kategori tugas sudah ada';
            $response->addErrorMessage($message);
        }else{
            try{
                $input['uuid']=$id;
                $this->taskCategoriesRepository->update($input);
            }catch (\Exception $exception){
                $response->addErrorMessage($exception->getMessage());
            }
        }

        return $response;
    }

    public function delete($id){
        return $this->deleteObject($this->taskCategoriesRepository,$id);
    }

}