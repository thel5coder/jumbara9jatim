<?php

namespace App\Repositories\Contracts;

interface ITasksRepository extends IBaseRepository
{
    public function isTaskExist($taskTitle,$uuid = null);

    public function getValuationTask();

    public function getValuationTaskNonMasal();
}