<?php

namespace App\Domains\Tettwi\Models\SlanderTweets;

use App\Domains\Tettwi\Models\SlanderTweets\EmbeddedTweet;
use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\Uuid;

class SlanderTweet
{

    private function __construct(
        public readonly TweetId $tweet_id,
        public readonly Uuid $user_id,
        public readonly Uuid $slanderer_id,
        public readonly EmbeddedTweet $embedded_tweet,
        public readonly int $slanderous_evaluations_num,
        public readonly int $fair_evaluations_num,
        public readonly int $bookmarks_num,
        public readonly ?string $tweeted_at,
        public readonly ?string $hidden_at
    ){}

    public static function create(
        TweetId $tweet_id,
        Uuid $user_id,
        Uuid $slanderer_id,
        EmbeddedTweet $embedded_tweet,
        ?int $slanderous_evaluations_num = 0,
        ?int $fair_evaluations_num = 0,
        ?int $bookmarks_num = 0,
        ?string $tweeted_at = null,
        ?string $hidden_at = null
    ):SlanderTweet
    {
        return new self(
            $tweet_id, $user_id, $slanderer_id,
            $embedded_tweet, $slanderous_evaluations_num, $fair_evaluations_num,
            $bookmarks_num, $tweeted_at, $hidden_at
        );
    }

    public static function reconstruct(
        TweetId $tweet_id,
        Uuid $slanderer_id,
        Uuid $user_id,
        EmbeddedTweet $embedded_tweet,
        int $slanderous_evaluations_num,
        int $fair_evaluations_num,
        int $bookmarks_num,
        string $tweeted_at,
        string $hidden_at
    ):SlanderTweet
    {
        return new self(
            $tweet_id, $user_id, $slanderer_id,
            $embedded_tweet, $slanderous_evaluations_num, $fair_evaluations_num,
            $bookmarks_num, $tweeted_at, $hidden_at
        );
    }


}
