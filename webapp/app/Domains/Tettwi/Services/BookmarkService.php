<?php

namespace App\Domains\Tettwi\Services;

use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\Uuid;
use App\Infrastructure\Repositories\BookmarkRepository;

class BookmarkService
{
    public function __construct(
        private readonly BookmarkRepository $BookmarkRepository
    ){}

    public function exists(TweetId $tweet_id, Uuid $user_id):bool
    {
        return $this->BookmarkRepository->exists($tweet_id, $user_id);
    }
}
