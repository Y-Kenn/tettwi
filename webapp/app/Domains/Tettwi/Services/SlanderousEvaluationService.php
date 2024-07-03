<?php

namespace App\Domains\Tettwi\Services;

use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\Uuid;
use App\Infrastructure\Repositories\SlanderousEvaluationRepository;

class SlanderousEvaluationService
{
    public function __construct(
        private readonly SlanderousEvaluationRepository $SlanderousEvaluationRepository
    ){}

    public function exists(TweetId $tweet_id, Uuid $user_id):bool
    {
        return $this->SlanderousEvaluationRepository->exists($tweet_id, $user_id);
    }
}
