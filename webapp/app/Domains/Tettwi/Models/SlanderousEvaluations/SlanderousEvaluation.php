<?php

namespace App\Domains\Tettwi\Models\SlanderousEvaluations;

use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\Uuid;

class SlanderousEvaluation
{

    private function __construct(
        public readonly Uuid $id,
        public readonly TweetId $slander_tweet_id,
        public readonly Uuid $user_id
    ){}

    public static function create(
        TweetId $slander_tweet_id,
        Uuid $user_id
    ):SlanderousEvaluation
    {
        $id = Uuid::generate();
        return new self($id, $slander_tweet_id, $user_id);
    }

    public static function reconstruct(
        Uuid $id,
        TweetId $slander_tweet_id,
        Uuid $user_id
    ):SlanderousEvaluation
    {
        return new self($id, $slander_tweet_id, $user_id);
    }


}
