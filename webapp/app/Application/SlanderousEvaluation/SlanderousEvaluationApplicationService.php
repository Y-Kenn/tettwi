<?php

namespace App\Application\SlanderousEvaluation;

use App\Domains\Tettwi\Models\SlanderousEvaluations\SlanderousEvaluation;
use App\Domains\Tettwi\Services\SlanderousEvaluationService;
use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\Uuid;
use App\Infrastructure\Repositories\SlanderousEvaluationRepository;
use Illuminate\Support\Facades\Log;

class SlanderousEvaluationApplicationService
{
    private readonly SlanderousEvaluationRepository $SlanderousEvaluationRepository;
    private readonly SlanderousEvaluationService $SlanderousEvaluationService;

    public function __construct(SlanderousEvaluationRepository $SlanderousEvaluationRepository)
    {
        $this->SlanderousEvaluationRepository = $SlanderousEvaluationRepository;
        $this->SlanderousEvaluationService
            = new SlanderousEvaluationService($this->SlanderousEvaluationRepository);
    }

    public function register(String $user_id_primitive, String $slander_tweet_id_primitive)
    {
        $slander_tweet_id = new TweetId($slander_tweet_id_primitive);
        $user_id = new Uuid($user_id_primitive);
        $exist_flag = $this->SlanderousEvaluationService->exists( $slander_tweet_id, $user_id);
        Log::debug('EXIST FLAG : ' . print_r($exist_flag, true));
        if($exist_flag) return null;

        $SlanderEvaluation = SlanderousEvaluation::create($slander_tweet_id, $user_id);
        $result = $this->SlanderousEvaluationRepository->insert($SlanderEvaluation);
        Log::debug('RESULTl : ' . print_r($result, true));
        if(!$result) return null;

        return $result;
    }

    public function delete(String $user_id_primitive, String $slander_tweet_id_primitive)
    {
        $slander_tweet_id = new TweetId($slander_tweet_id_primitive);
        $user_id = new Uuid($user_id_primitive);
        $exist_flag = $this->SlanderousEvaluationService->exists( $slander_tweet_id, $user_id);
        if($exist_flag) return null;

        $SlanderEvaluation = SlanderousEvaluation::create($slander_tweet_id, $user_id);
        $result = $this->SlanderousEvaluationRepository->insert($SlanderEvaluation);
        if(!$result) return null;

        return $result;
    }
}
