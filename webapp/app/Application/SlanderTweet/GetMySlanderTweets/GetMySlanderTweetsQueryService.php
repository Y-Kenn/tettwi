<?php

namespace App\Application\SlanderTweet\GetMySlanderTweets;


use App\Domains\Tettwi\Shared\Uuid;
use App\Infrastructure\EloquentModels\EMSlanderTweet;

class GetMySlanderTweetsQueryService
{
    public function getMySlanderTweets(Uuid $user_id):array
    {
        return EMSlanderTweet::where('user_id', $user_id->value())
            ->orderBy('created_at', 'desc')->get()->toArray();
    }

}
