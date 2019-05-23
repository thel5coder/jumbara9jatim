<?php

namespace App\Http\Controllers;

use App\Services\DownloadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    protected $downloadService;

    public function __construct(DownloadService $downloadService)
    {
        $this->downloadService = $downloadService;
    }

    public function create(){
        $result = $this->downloadService->create(Input::all());

        return $this->getJsonResponse($result);
    }

    public function read($id){
        $result = $this->downloadService->read($id);

        return $this->getJsonResponse($result);
    }

    public function showAll(){
        $result = $this->downloadService->showAll();

        return $this->getJsonResponse($result);
    }

    public function update(){
        $result = $this->downloadService->update(Input::all());

        return $this->getJsonResponse($result);
    }

    public function delete($id){
        $result = $this->downloadService->delete($id);

        return $this->getJsonResponse($result);
    }

    public function uploadDownloadDocument(){
        $result = $this->downloadService->uploadDownloadDocument(Input::file('file'));

        return $this->getJsonResponse($result);
    }

    public function downloadFile($slug,$fileToDownload){
        $result = $this->downloadService->updateDownloadCount($slug,$fileToDownload);

        $headers = array(
            'Content-Type: image/jpeg',
        );

        return response()->download($result->getResult(), $fileToDownload, $headers);
    }
}
