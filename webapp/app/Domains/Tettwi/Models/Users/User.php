<?php

namespace App\Domains\Tettwi\Models\Users;

use App\Domains\Tettwi\Models\Users\UserId;
use App\Domains\Tettwi\Models\Users\Username;
use PhpParser\Node\Scalar\String_;

final class User
{
    private UserId $user_id;
    private Username $username;

    public function __construct(UserId $user_id, Username $username)
    {
        $this->user_id = $user_id;
        $this->username = $username;
    }

    public function showUserId():String
    {
        return $this->user_id->value();
    }



}
