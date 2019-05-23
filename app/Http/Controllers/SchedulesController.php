<?php

namespace App\Http\Controllers;

use App\Services\SchedulesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SchedulesController extends Controller
{
    protected $scheduleService;

    public function __construct(SchedulesService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function create(){
        $result = $this->scheduleService->create(Input::all());

        return $this->getJsonResponse($result);
    }

    public function read($id){
        $result = $this->scheduleService->read($id);

        return $this->getJsonResponse($result);
    }

    public function showAll(){
        $result = $this->scheduleService->showAll();

        return $this->getJsonResponse($result);
    }

    public function update($id){
        $result = $this->scheduleService->update(Input::all(),$id);

        return $this->getJsonResponse($result);
    }

    public function delete($uuid){
        $result = $this->scheduleService->delete($uuid);

        return $this->getJsonResponse($result);
    }

    public function getScheduleValuationAll(){
        $result = $this->scheduleService->getScheduleValuationAll();

        return $this->getJsonResponse($result);
    }
}
