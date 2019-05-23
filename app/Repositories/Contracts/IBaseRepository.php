<?php

namespace App\Repositories\Contracts;


interface IBaseRepository {

    public function create($input);

    public function update($input);

    public function delete($id);

    public function read($id);

    public function showAll();

    public function pagination($searchPhrase = null);
}
