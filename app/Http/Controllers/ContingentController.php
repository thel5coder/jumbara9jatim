<?php

namespace App\Http\Controllers;

use App\Services\ContingentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ContingentController extends Controller
{
    protected $contingentService;

    public function __construct(ContingentService $contingentService)
    {
        $this->contingentService = $contingentService;
    }

    public function create(){
        $result = $this->contingentService->create(Input::all());

        return $this->getJsonResponse($result);
    }

    public function read($id){
        $result = $this->contingentService->read($id);

        return $this->getJsonResponse($result);
    }

    public function showAll(){
        $result = $this->contingentService->showAll();

        return $this->getJsonResponse($result);
    }

    public function update(){
        $result = $this->contingentService->update(Input::all());

        return $this->getJsonResponse($result);
    }

    public function delete($id){
        $result = $this->contingentService->delete($id);

        return $this->getJsonResponse($result);
    }

    public function pagination(){
        $result = $this->contingentService->pagination();

        return $this->getJsonResponse($result);
    }
}
