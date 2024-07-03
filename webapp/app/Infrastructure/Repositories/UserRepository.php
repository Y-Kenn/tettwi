<?php

namespace App\Infrastructure\Repositories;

use App\Domains\Tettwi\Models\Users\User;
use App\Domains\Tettwi\Models\Users\UserId;
use App\Domains\Tettwi\Models\Users\Username;
use App\Infrastructure\EloquentModels\EMUser;

class UserRepository
{
    public function find(UserId $user_id):User
    {
        $user = EMUser::find($user_id->value());
        //dd($user_id->toString(), $user->toArray());

        return new User(
            new UserId($user->id),
            new Username($user->username)
        );
    }
}
