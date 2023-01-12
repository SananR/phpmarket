<?php

namespace App\Repositories;

use App\Interfaces\UserRepository;
use App\Models\User;

class EloquentUserRepository extends UserRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

}
