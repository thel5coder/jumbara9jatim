<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-24
 * Time: 06:00
 */

namespace App\Services;


use App\Repositories\Contracts\IInformationRepository;
use App\Services\Response\ServiceResponseDto;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class InformationService extends BaseService
{
    protected $informationRepository;

    public function __construct(IInformationRepository $informationRepository)
    {
        $this->informationRepository = $informationRepository;
    }

    public function create($input){
        $response = new ServiceResponseDto();
        $input['slug'] = $this->generateSlug($input['title']);

        try{
            $this->informationRepository->create($input);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function read($id){
        return $this->readObject($this->informationRepository,$id);
    }

    public function showAll(){
        return $this->getAllObject($this->informationRepository);
    }

    public function getBySlug($slug){
        $response = new ServiceResponseDto();

        $response->setResult($this->informationRepository->getBySlug($slug));

        return $response;
    }

    public function update($input){
        $response = new ServiceResponseDto();
        $input['slug'] = $this->generateSlug($input['title']);

        try{
            $this->informationRepository->update($input);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function delete($id){
        return $this->deleteObject($this->informationRepository,$id);
    }

    protected function getExistingViewCount($slug){
        $response = new ServiceResponseDto();

        $response->setResult($this->informationRepository->existingCounter($slug));

        return $response;
    }

    public function updateViewCounter($slug){
        $response = new ServiceResponseDto();
        $existingCounter = $this->getExistingViewCount($slug)->getResult();
        $newCounter = $existingCounter+1;

        try{
            $this->informationRepository->updateCounter($slug,$newCounter);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function uploadImage($file){
        $response = new ServiceResponseDto();

        try{
            $file->storeAs('public/',$file->getClientOriginalName());
            $image = Image::make($file);
            $image->resize(400,600);
            Storage::put('public/resized/'.$file->getClientOriginalName(),(string)$image->encode());
            $response->setResult($file->getClientOriginalName());

        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        return $response;
    }
}