<?php

namespace App\Domains\Tettwi\Services;

use App\Domains\Tettwi\Shared\TwitterUsername;
use App\Infrastructure\Repositories\SlandererRepository;

class SlandererService
{
    public function __construct(
        private readonly SlandererRepository $SlandererRepository
    ){}

    public function exists(TwitterUsername $twitter_username):bool
    {
        return $this->SlandererRepository->exists($twitter_username);
    }

}
