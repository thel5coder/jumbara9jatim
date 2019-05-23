<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(){
        $result = $this->userService->create(Input::all());

        return $this->getJsonResponse($result);
    }

    public function read($id){
        $result = $this->userService->read($id);

        return $this->getJsonResponse($result);
    }

    public function showAll(){
        $result= $this->userService->showAll();

        return $this->getJsonResponse($result);
    }

    public function update(){
        $result = $this->userService->update(Input::all());

        return $this->getJsonResponse($result);
    }

    public function updateProfile(){
        $result = $this->userService->updateProfile(Input::all());

        return $this->getJsonResponse($result);
    }

    public function delete($id){
        $result = $this->userService->delete($id);

        return $this->getJsonResponse($result);
    }
}
