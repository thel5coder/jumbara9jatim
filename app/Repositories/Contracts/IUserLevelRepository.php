<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-22
 * Time: 09:20
 */

namespace App\Repositories\Contracts;


interface IUserLevelRepository extends IBaseRepository
{
    public function isUserLevelExist($levelName,$id = null);
}