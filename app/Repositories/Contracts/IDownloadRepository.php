<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-24
 * Time: 09:16
 */

namespace App\Repositories\Contracts;


interface IDownloadRepository extends IBaseRepository
{
    public function getDownloadBySlug($slug);

    public function getExistingDownloadCount($slug);

    public function updateDownloadCount($slug,$counter);
}