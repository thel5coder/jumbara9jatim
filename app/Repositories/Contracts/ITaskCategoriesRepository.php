<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-05-05
 * Time: 07:43
 */

namespace App\Repositories\Contracts;


interface ITaskCategoriesRepository extends IBaseRepository
{
    public function isCategoryNameExist($categoryName,$uuid = null);
}