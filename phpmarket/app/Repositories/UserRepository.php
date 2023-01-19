<?php

namespace App\Repositories;

use App\Interfaces\BaseRepository;

abstract class UserRepository extends BaseRepository
{

    public function __construct($modelOrm) {
        parent::__construct($modelOrm);
    }

    public function checkAdmin($id) {
        return $this->getById($id)->isOfType('admin');
    }
}
