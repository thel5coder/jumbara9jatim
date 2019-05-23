<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-24
 * Time: 09:31
 */

namespace App\Services;


use App\Repositories\Contracts\IDownloadRepository;
use App\Services\Response\ServiceResponseDto;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DownloadService extends BaseService
{
    protected $downloadRepository;

    public function __construct(IDownloadRepository $downloadRepository)
    {
        $this->downloadRepository = $downloadRepository;
    }

    public function create($input){
        $response = new ServiceResponseDto();
        $input['slug'] = $this->generateSlug($input['title']);

        try{
            $this->downloadRepository->create($input);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function read($id){
        return $this->readObject($this->downloadRepository,$id);
    }

    public function showAll(){
        return $this->getAllObject($this->downloadRepository);
    }

    public function getBySlug($slug){
        $response = new ServiceResponseDto();

        $response->setResult($this->downloadRepository->getDownloadBySlug($slug));

        return $response;
    }

    public function update($input){
        $response = new ServiceResponseDto();
        $input['slug'] = $this->generateSlug($input['title']);

        try{
            $this->downloadRepository->update($input);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function delete($id){
        return $this->deleteObject($this->downloadRepository,$id);
    }

    protected function getCurrentCounter($slug){
        $response = new ServiceResponseDto();

        $response->setResult($this->downloadRepository->getExistingDownloadCount($slug));

        return $response;
    }

    public function updateDownloadCount($slug,$fileToDownload){
        $response = new ServiceResponseDto();
        $currentDownloadCount = $this->getCurrentCounter($slug)->getResult();
        $newCount = $currentDownloadCount+1;

        try{
            $this->downloadRepository->updateDownloadCount($slug,$newCount);
            $url = public_path().'/storage/download/'.$fileToDownload;
            $response->setResult($url);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function uploadDownloadDocument($file){
        $response = new ServiceResponseDto();

        try{
            $file->storeAs('public/download/',$file->getClientOriginalName());

            $response->setResult($file->getClientOriginalName());

        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        return $response;
    }
}