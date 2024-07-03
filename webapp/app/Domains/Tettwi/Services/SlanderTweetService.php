<?php

namespace App\Domains\Tettwi\Services;

use App\Domains\Tettwi\Models\SlanderTweets\TweetUrl;
use App\Domains\Tettwi\Shared\TweetId;
use App\Infrastructure\Repositories\SlanderTweetRepository;

class SlanderTweetService
{
    public function __construct(
        private readonly SlanderTweetRepository $SlanderTweetRepository
    ){}

    public function exists(TweetId $tweetId):bool
    {
        return $this->SlanderTweetRepository->exists($tweetId);
    }
}
