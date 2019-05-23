<?php

namespace App\Http\Controllers;

use App\Services\ParticipantTasksService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ParticipantTasksController extends Controller
{
    protected $participantTasksService;

    public function __construct(ParticipantTasksService $participantTasksService)
    {
        $this->participantTasksService = $participantTasksService;
    }

    public function create(){
        $result = $this->participantTasksService->create(Input::all());

        return $this->getJsonResponse($result);
    }

    public function getParticipantTaskByContingent($contingentId){
        $result = $this->participantTasksService->getParticipantTaskByContingent($contingentId);

        return $this->getJsonResponse($result);
    }
}
