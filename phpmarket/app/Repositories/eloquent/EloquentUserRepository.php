<?php

namespace App\Repositories\eloquent;

use App\Models\User;
use App\Repositories\UserRepository;

class EloquentUserRepository extends UserRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

}
