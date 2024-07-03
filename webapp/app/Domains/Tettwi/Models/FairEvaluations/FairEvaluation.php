<?php

namespace App\Domains\Tettwi\Models\FairEvaluations;

use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\Uuid;

class FairEvaluation
{

    private function __construct(
        public readonly Uuid $id,
        public readonly Uuid $user_id,
        public readonly TweetId $slander_tweet_id
    ){}

    public static function create(
        TweetId $slander_tweet_id,
        Uuid $user_id
    ):FairEvaluation
    {
        $id = Uuid::generate();
        return new self($id, $user_id, $slander_tweet_id);
    }

    public static function reconstruct(
        Uuid $id,
        Uuid $user_id,
        TweetId $slander_tweet_id
    ):FairEvaluation
    {
        return new self($id, $user_id, $slander_tweet_id);
    }


}
