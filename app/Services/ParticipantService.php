<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-08
 * Time: 05:09
 */

namespace App\Services;


use App\Repositories\Contracts\IContingentRepository;
use App\Repositories\Contracts\IParticipantRepository;
use App\Repositories\Contracts\IPositionRepository;
use App\Services\Response\ServiceResponseDto;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Mockery\Exception;

class ParticipantService extends BaseService
{

    protected $participantRepository;
    protected $positionRepository;
    protected $contingentRepository;

    public function __construct(IParticipantRepository $participantRepository,IPositionRepository $positionRepository,IContingentRepository $contingentRepository)
    {
        $this->participantRepository = $participantRepository;
        $this->positionRepository = $positionRepository;
        $this->contingentRepository = $contingentRepository;
    }

    protected function isParticipantExist($mis,$id = null){
        $response = new ServiceResponseDto();

        $response->setResult($this->participantRepository->isParticipantExist($mis,$id));

        return $response;
    }

    protected function getCountParticipantByPositionPerContingent($contingentId,$positionId,$id=null){
        $response = new ServiceResponseDto();

        $response->setResult($this->participantRepository->getCountParticipantByPositionPerContingent($contingentId,$positionId,$id));

        return $response;
    }

    protected function getCountParticipantByContingent($contingentId){
        $response = new ServiceResponseDto();

        $response->setResult($this->participantRepository->getCountParticipantByContingent($contingentId));

        return $response;
    }

    public function create($input){
        $response = new ServiceResponseDto();
        $limitParticipant = $this->positionRepository->getLimitParticipant($input['positionId']);
        $countParticipant = $this->getCountParticipantByPositionPerContingent($input['contingentId'],$input['positionId'])->getResult();
        $positionName = $this->positionRepository->getPositionName($input['positionId']);
        $contingentId = $this->contingentRepository->getContingentId($input['contingentId']);
        $positionId = $this->positionRepository->getPositionId($input['positionId']);

        if($limitParticipant == $countParticipant){
            $message  = 'Maaf peserta untuk posisi '.$positionName.
                ' sudah memenuhi kuota, anda tidak bisa menambahkan peserta pada posisi'.$positionName.' lagi';
            $response->addErrorMessage($message);
        }else {
            $isParticipantExist = $this->isParticipantExist($input['mis'])->getResult();
            if($isParticipantExist){
                $message= 'Peserta dengan no KTA '.$input['mis'].' sudah ada';
                $response->addErrorMessage($message);
            }else{
                $count = $this->getCountParticipantByContingent($input['contingentId'])->getResult();

                $response->setResult($count);

                if($count >= 9){
                    $participantNumber = $count+1;
                }else{
                    $participantNumber = '0'.($count+1);
                }
                $input['participantId']=$contingentId.''.$positionId;
                $input['participantNumber'] = $participantNumber;


                try{
                    $this->participantRepository->create($input);
                }catch (\Exception $exception){
                    $message = $exception->getMessage();
                    $response->addErrorMessage($message);
                }
            }
        }

        return $response;
    }

    public function read($id){
        return $this->readObject($this->participantRepository,$id);
    }

    public function showAll(){
        return $this->getAllObject($this->participantRepository);
    }

    public function update($input){
        $response = new ServiceResponseDto();
        $limitParticipant = $this->positionRepository->getLimitParticipant($input['positionId']);
        $countParticipant = $this->getCountParticipantByPositionPerContingent($input['contingentId'],$input['positionId'],$input['id'])->getResult();
        $positionName = $this->positionRepository->getPositionName($input['positionId']);
        $contingentId = $this->contingentRepository->getContingentId($input['contingentId']);
        $positionId = $this->positionRepository->getPositionId($input['positionId']);

        if($limitParticipant == $countParticipant){
            $message  = 'Maaf peserta untuk posisi '.$positionName.
                ' sudah memenuhi kuota, anda tidak bisa menambahkan peserta pada posisi'.$positionName.' lagi';
            $response->addErrorMessage($message);
        }else {
            $isParticipantExist = $this->isParticipantExist($input['mis'],$input['id'])->getResult();
            if($isParticipantExist){
                $message= 'Peserta dengan no KTA '.$input['mis'].' sudah ada';
                $response->addErrorMessage($message);
            }else{
                $input['participantId']=$contingentId.''.$positionId;


                try{
                    $this->participantRepository->update($input);
                }catch (\Exception $exception){
                    $message = $exception->getMessage();
                    $response->addErrorMessage($message);
                }
            }
        }

        return $response;
    }

    public function delete($id){
        $response = new ServiceResponseDto();
        $file = $this->participantRepository->read($id);
        $deleteDocument = $this->deleteDocument($file);

        if($deleteDocument->isSuccess()){
            try{
                $this->participantRepository->delete($id);

            }catch (\Exception $exception){
                $response->addErrorMessage($exception->getMessage());
            }
        }else{
            $response->addErrorMessage($deleteDocument->getErrorMessages());
        }

        return $response;
    }

    public function pagination(){

    }

    public function paginationByContingent($contingentId){
        $response = new ServiceResponseDto();
        $data = [];

        try{
            $participants = $this->participantRepository->getParticipantByContingent($contingentId);
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        foreach ($participants as $participant) {
            $data[]=[

                'id'=>$participant['id'],
                'contingentName'=>$participant['contingentName'],
                'contingentId'=>$participant['contingentId'],
                'participantId'=>$participant['participantId'],
                'participantNumber'=>$participant['participantNumber'],
                'mis'=>$participant['mis'],
                'fullName'=>$participant['fullName'],
                'birthPlace'=>$participant['birthPlace'],
                'birthDate'=>$participant['birthDate'],
                'sex'=>$participant['sex'],
                'religion'=>$participant['religion'],
                'address'=>$participant['address'],
                'phone'=>$participant['phone'],
                'groupMember'=>$participant['groupMember'],
                'positionName'=>$participant['positionName'],
                'positionId'=>$participant['positionId'],
                'email'=>$participant['email'],
                'photograph'=>$participant['photograph'],
                'ansurance'=>$participant['ansurance'],
                'misImage'=>$participant['misImage'],
                'isActive'=>$participant['isActive']
            ];
        }
        $response->setResult($data);

        return $response;
    }

    public function uploadDocument($file){
        $response = new ServiceResponseDto();

        try{
            $file->storeAs('public/document/',$file->getClientOriginalName());
            $image = Image::make($file);
            $image->resize(400,600);
            Storage::put('public/document/resized/'.$file->getClientOriginalName(),(string)$image->encode());
            $response->setResult($file->getClientOriginalName());

        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function deleteDocument($file){
        $response = new ServiceResponseDto();

        try{
            Storage::delete('/public/document/'.$file['misImage']);
            Storage::delete('/public/document/resized/'.$file['misImage']);
            Storage::delete('/public/document/'.$file['photograph']);
            Storage::delete('/public/document/resized/'.$file['photograph']);
            Storage::delete('/public/document/'.$file['ansurance']);
            Storage::delete('/public/document/resized/'.$file['ansurance']);

        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function getParticipantByGroup($group){
        $response = new ServiceResponseDto();

        $response->setResult($this->participantRepository->getParticipantByGroup($group));

        return $response;
    }

    public function getParticipantStatistic(){
        $response = new ServiceResponseDto();

        $response->setResult($this->participantRepository->participantStatisticSummary());

        return $response;
    }

}