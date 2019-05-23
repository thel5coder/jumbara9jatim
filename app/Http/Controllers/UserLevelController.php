<?php

namespace App\Http\Controllers;

use App\Services\UserLevelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UserLevelController extends Controller
{
    protected $userLevelService;

    public function __construct(UserLevelService $userLevelService)
    {
        $this->userLevelService = $userLevelService;
    }

    public function create(){
        $result = $this->userLevelService->create(Input::all());

        return $this->getJsonResponse($result);
    }

    public function read($id){
        $result = $this->userLevelService->read($id);

        return $this->getJsonResponse($result);
    }

    public function showAll(){
        $result = $this->userLevelService->showAll();

        return $this->getJsonResponse($result);
    }

    public function update(){
        $result = $this->userLevelService->update(Input::all());

        return $this->getJsonResponse($result);
    }

    public function delete($id){
        $result = $this->userLevelService->delete($id);

        return $this->getJsonResponse($result);
    }
}
