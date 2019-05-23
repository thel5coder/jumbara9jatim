<?php

namespace App\Http\Controllers;

use App\Services\ParticipantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ParticipantController extends Controller
{
    protected $participantService;

    public function __construct(ParticipantService $participantService)
    {
        $this->participantService = $participantService;
    }

    public function create(){
        $result = $this->participantService->create(Input::all());

        return $this->getJsonResponse($result);
    }

    public function read($id){
        $result = $this->participantService->read($id);

        return $this->getJsonResponse($result);
    }

    public function showAll(){
        $result = $this->participantService->showAll();

        return $this->getJsonResponse($result);
    }

    public function update(){
        $result = $this->participantService->update(Input::all());

        return $this->getJsonResponse($result);
    }

    public function delete($id){
        $result = $this->participantService->delete($id);

        return $this->getJsonResponse($result);
    }

    public function pagination($contingentId){

    }

    public function paginationByContingent($contingentId){
        $result = $this->participantService->paginationByContingent($contingentId);

        return $this->getJsonResponse($result);
    }

    public function uploadDocument(){
        $result = $this->participantService->uploadDocument(Input::file('file'),Input::get('userDir'));

        return $this->getJsonResponse($result);
    }

    public function deleteDocument(){
        $result = $this->participantService->deleteDocument(Input::get('file'),Input::get('userDir'),Input::get('documentType'),Input::get('id'));

        return $this->getJsonResponse($result);
    }

    public function getParticipantStatistic(){
        $result = $this->participantService->getParticipantStatistic();

        return $this->getJsonResponse($result);
    }
}
