<?php

namespace App\Repositories\Contracts;


interface IParticipantRepository extends IBaseRepository
{
    public function getParticipantByContingent($contingentId);

    public function isParticipantExist($mis,$id = null);

    public function getCountParticipantByPositionPerContingent($contingentId,$positionId,$id = null);

    public function getCountParticipantByContingent($contingentId);

    public function changeDocument($documentType,$id);

    public function getParticipantByGroup($group);

    public function participantStatisticSummary();

}