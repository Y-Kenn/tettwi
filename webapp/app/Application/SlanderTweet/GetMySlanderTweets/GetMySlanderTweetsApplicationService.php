<?php

namespace App\Application\SlanderTweet\GetMySlanderTweets;

use App\Domains\Tettwi\Shared\Uuid;

class GetMySlanderTweetsApplicationService
{
    private readonly GetMySlanderTweetsQueryService $MySlanderTweetsQS;
    public function __construct(){
        $this->MySlanderTweetsQS = new GetMySlanderTweetsQueryService();
    }
    public function getMySlanderTweets(string $user_id_primitive):array
    {
        $user_id = new Uuid($user_id_primitive);
        return  $this->MySlanderTweetsQS->getMySlanderTweets($user_id);
    }
}
