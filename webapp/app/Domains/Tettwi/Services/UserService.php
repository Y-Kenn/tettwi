<?php

namespace App\Domains\Tettwi\Services;

use App\Domains\Tettwi\Models\Users\UserId;
use App\Domains\Tettwi\Models\Users\Username;
use App\Infrastructure\Repositories\UserRepository;
use App\Domains\Tettwi\Models\Users\IUserRepository;

class UserService
{
    private UserRepository $UserRepository;

    public function __construct(IUserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }
    public function exists(Username $username):bool
    {


        return true;
    }

    public function test($user_id)
    {
        $user_id_vo = new UserId($user_id);

        $entity = $this->UserRepository->find($user_id_vo);
        return $entity;//->showUserId();
    }
}
