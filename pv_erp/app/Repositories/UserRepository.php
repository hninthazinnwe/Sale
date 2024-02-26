<?php

use App\Http\Controllers\UserController;
use App\Repositories;
use App\Repositories\BaseRepository;

Class UserRepository extends BaseRepository {
    protected $user;

    function __construct(UserController $user)
    {
        $this->user = $user;   
    }
}