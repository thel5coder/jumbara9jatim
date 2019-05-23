<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-24
 * Time: 05:40
 */

namespace App\Repositories\Contracts;


interface IInformationRepository extends IBaseRepository
{
    public function updateCounter($slug,$counter);

    public function existingCounter($slug);

    public function getBySlug($slug);
}