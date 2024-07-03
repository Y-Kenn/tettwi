<?php

namespace App\Application\Slanderer;

use App\Domains\Tettwi\Models\Slanderers\Slanderer;
use App\Domains\Tettwi\Services\SlandererService;
use App\Domains\Tettwi\Shared\TwitterIcon;
use App\Domains\Tettwi\Shared\TwitterId;
use App\Domains\Tettwi\Shared\TwitterUsername;
use App\Infrastructure\Repositories\SlandererRepository;

class SlandererApplicationService
{
    private readonly SlandererRepository $SlandererRepository;
    private readonly SlandererService $SlandererService;

    public function __construct(SlandererRepository $SlandererRepository)
    {
        $this->SlandererRepository = $SlandererRepository;
        $this->SlandererService = new SlandererService($SlandererRepository);
    }

    public function register(TwitterId $twitter_id, TwitterUsername $twitter_username, TwitterIcon $twitter_icon)
    {
        $Slanderer = Slanderer::create($twitter_id, $twitter_username, $twitter_icon);
        $exists_flag = $this->SlandererService->exists($Slanderer);
        if(!$exists_flag){
            $result = $this->SlandererRepository->insert($Slanderer);
            if(!$result) throw new \Exception();
        }
    }
}
