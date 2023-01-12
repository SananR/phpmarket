<?php

namespace App\Interfaces;

abstract class UserRepository extends BaseRepository
{

    public function __construct($modelOrm) {
        parent::__construct($modelOrm);
    }

    public function checkAdmin($id) {
        return $this->getById($id)->isOfType('admin');
    }
}
