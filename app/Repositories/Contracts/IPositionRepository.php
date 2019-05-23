<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-05
 * Time: 03:54
 */

namespace App\Repositories\Contracts;


interface IPositionRepository extends IBaseRepository
{
    public function isPositionExist($positionName,$positionId);

    public function getLimitParticipant($id);

    public function getPositionName($id);

    public function getPositionId($id);
}