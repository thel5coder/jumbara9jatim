<?php

namespace App\Repositories\Contracts;


interface ISchedulesRepository extends IBaseRepository
{
    public function isScheduleExist($taskUuid,$date,$scheduleTime,$uuid = null);

    public function getScheduleValuationAll();

    public function getScheduleValuationFiltered($taskCategoryUuid,$scheduleDate,$scheduleTime);
}