<?php

namespace App\Http\Controllers;

use App\Services\TaskCategoriesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TaskCategoriesController extends Controller
{
    protected $taskCategoriesService;

    public function __construct(TaskCategoriesService $taskCategoriesService)
    {
        $this->taskCategoriesService = $taskCategoriesService;
    }

    public function create(){
        $result = $this->taskCategoriesService->create(Input::all());

        return $this->getJsonResponse($result);
    }

    public function read($id){
        $result = $this->taskCategoriesService->read($id);

        return $this->getJsonResponse($result);
    }

    public function showAll(){
        $result = $this->taskCategoriesService->showAll();

        return $this->getJsonResponse($result);
    }

    public function update($uuid){
        $result = $this->taskCategoriesService->update(Input::all(),$uuid);

        return $this->getJsonResponse($result);
    }

    public function delete($id){
        $result = $this->taskCategoriesService->delete($id);

        return $this->getJsonResponse($result);
    }
}
