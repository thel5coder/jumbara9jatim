<?php
/**
 * Created by PhpStorm.
 * User: syaikhul
 * Date: 05/03/2018
 * Time: 16.49
 */

namespace App\Repositories\Contracts;


interface IUserRepository extends IBaseRepository
{

    public function isUserNameExist($userName,$id= null);

    public function changePassword($userName,$password);

    public function updateProfileUserContingent($input);
}