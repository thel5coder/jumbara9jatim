<?php

namespace App\Http\Controllers;

use App\Services\InformationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class InformationController extends Controller
{
    protected $informationService;

    public function __construct(InformationService $informationService)
    {
        $this->informationService = $informationService;
    }

    public function create(){
        $result = $this->informationService->create(Input::all());

        return $this->getJsonResponse($result);
    }

    public function read($id){
        $result = $this->informationService->read($id);

        return $this->getJsonResponse($result);
    }

    public function showAll(){
        $result = $this->informationService->showAll();

        return $this->getJsonResponse($result);
    }

    public function getBySlug($slug){
        $result= $this->informationService->getBySlug($slug);

        return $this->getJsonResponse($result);
    }

    public function update(){
        $result = $this->informationService->update(Input::all());

        return $this->getJsonResponse($result);
    }

    public function delete($id){
        $result = $this->informationService->delete($id);

        return $this->getJsonResponse($result);
    }

    public function updateCounter($slug){
        $result = $this->informationService->updateViewCounter($slug);

        return $this->getJsonResponse($result);
    }

    public function uploadImage(){
        $result = $this->informationService->uploadImage(Input::file('file'));

        return $this->getJsonResponse($result);
    }
}
