<?php

namespace App\Domains\Tettwi\Services;

use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\Uuid;
use App\Infrastructure\Repositories\FairEvaluationRepository;

class FairEvaluationService
{
    public function __construct(
        private readonly FairEvaluationRepository $FairEvaluationRepository
    ){}

    public function exists(TweetId $tweet_id, Uuid $user_id):bool
    {
        return $this->FairEvaluationRepository->exists($tweet_id, $user_id);
    }
}
