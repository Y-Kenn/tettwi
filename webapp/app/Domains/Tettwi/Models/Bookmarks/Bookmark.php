<?php

namespace App\Domains\Tettwi\Models\Bookmarks;

use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\Uuid;

class Bookmark
{

    private function __construct(
        public readonly Uuid $id,
        public readonly Uuid $user_id,
        public readonly TweetId $slander_tweet_id
    ){}

    public static function create(
        TweetId $slander_tweet_id,
        Uuid $user_id
    ):Bookmark
    {
        $id = Uuid::generate();
        return new self($id, $user_id, $slander_tweet_id);
    }

    public static function reconstruct(
        Uuid $id,
        Uuid $user_id,
        TweetId $slander_tweet_id
    ):Bookmark
    {
        return new self($id, $user_id, $slander_tweet_id);
    }


}
