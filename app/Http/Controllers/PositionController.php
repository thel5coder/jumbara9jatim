<?php

namespace App\Http\Controllers;

use App\Services\PositionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PositionController extends Controller
{
    protected $positionService;

    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }

    public function create(){
        $result = $this->positionService->create(Input::all());

        return $this->getJsonResponse($result);
    }

    public function read($id){
        $result = $this->positionService->read($id);

        return $this->getJsonResponse($result);
    }

    public function showAll(){
        $result = $this->positionService->showAll();

        return $this->getJsonResponse($result);
    }

    public function update(){
        $result = $this->positionService->update(Input::all());

        return $this->getJsonResponse($result);
    }

    public function delete($id){
        $result = $this->positionService->delete($id);

        return $this->getJsonResponse($result);
    }

    public function pagination(){
        $result = $this->positionService->pagination();

        return $this->getJsonResponse($result);
    }
}
