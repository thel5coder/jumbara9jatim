<?php

namespace App\Repositories\Contracts;


interface IParticipantTasksRepository extends IBaseRepository
{
    public function getParticipantTasksByContingent($contingentId);

    public function deleteTask($participantId,$taskUuid);
}