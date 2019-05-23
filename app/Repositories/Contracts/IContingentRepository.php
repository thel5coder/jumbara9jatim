<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-08
 * Time: 02:57
 */

namespace App\Repositories\Contracts;


interface IContingentRepository extends IBaseRepository
{
    public function isContingentExist($contingentId,$contingentName,$id = null);

    public function getContingentId($id);
}