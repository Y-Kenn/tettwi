<?php

namespace App\Application\FairEvaluation;

use App\Domains\Tettwi\Models\FairEvaluations\FairEvaluation;
use App\Domains\Tettwi\Models\SlanderousEvaluations\SlanderousEvaluation;
use App\Domains\Tettwi\Services\FairEvaluationService;
use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\Uuid;
use App\Infrastructure\Repositories\FairEvaluationRepository;
use Illuminate\Support\Facades\Log;

class FairEvaluationApplicationService
{
    private readonly FairEvaluationRepository $FairEvaluationRepository;
    private readonly FairEvaluationService $FairEvaluationService;

    public function __construct(FairEvaluationRepository $FairEvaluationRepository)
    {
        $this->FairEvaluationRepository = $FairEvaluationRepository;
        $this->FairEvaluationService
            = new FairEvaluationService($this->FairEvaluationRepository);
    }

    public function register(String $user_id_primitive, String $slander_tweet_id_primitive)
    {
        $slander_tweet_id = new TweetId($slander_tweet_id_primitive);
        $user_id = new Uuid($user_id_primitive);
        $exist_flag = $this->FairEvaluationService->exists( $slander_tweet_id, $user_id);
        Log::debug('EXIST FLAG : ' . print_r($exist_flag, true));
        if($exist_flag) return null;

        $FairEvaluation = FairEvaluation::create($slander_tweet_id, $user_id);
        $result = $this->FairEvaluationRepository->insert($FairEvaluation);
        Log::debug('RESULTl : ' . print_r($result, true));
        if(!$result) return null;

        return $result;
    }

    public function delete(String $user_id_primitive, String $slander_tweet_id_primitive)
    {
        $slander_tweet_id = new TweetId($slander_tweet_id_primitive);
        $user_id = new Uuid($user_id_primitive);
        $exist_flag = $this->FairEvaluationService->exists( $slander_tweet_id, $user_id);
        if($exist_flag) return null;

        $FairEvaluation = FairEvaluation::create($slander_tweet_id, $user_id);
        $result = $this->FairEvaluationRepository->insert($FairEvaluation);
        if(!$result) return null;

        return $result;
    }
}
