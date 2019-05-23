<?php

namespace App\Http\Controllers;

use App\Services\TasksService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TasksController extends Controller
{
    protected $tasksService;

    public function __construct(TasksService $tasksService)
    {
        $this->tasksService = $tasksService;
    }

    public function create(){
        $result = $this->tasksService->create(Input::all());

        return $this->getJsonResponse($result);
    }

    public function read($uuid){
        $result = $this->tasksService->read($uuid);

        return $this->getJsonResponse($result);
    }

    public function showAll(){
        $result = $this->tasksService->showAll();

        return $this->getJsonResponse($result);
    }

    public function update($uuid){
        $result = $this->tasksService->update(Input::all(),$uuid);

        return $this->getJsonResponse($result);
    }

    public function delete($uuid){
        $result = $this->tasksService->delete($uuid);

        return $this->getJsonResponse($result);
    }

    public function getValuationNonMasal(){
        $result = $this->tasksService->getValuationTaskNonMasal();

        return $this->getJsonResponse($result);
    }
}
