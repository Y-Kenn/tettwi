<?php

namespace App\Infrastructure\Repositories;


use App\Domains\Tettwi\Models\FairEvaluations\FairEvaluation;
use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\Uuid;
use App\Infrastructure\EloquentModels\EMFairEvaluation;

class FairEvaluationRepository
{
    public function exists(TweetId $tweet_id, Uuid $user_id):bool
    {
        return EMFairEvaluation::where('slander_tweet_id', $tweet_id->value())
                                        ->where('user_id', $user_id->value())
                                        ->exists();
    }
    public function find(Uuid $id):?FairEvaluation
    {
        $fair_evaluation = EMFairEvaluation::find($id->value());

        if(is_null($fair_evaluation)) return null;

        return FairEvaluation::reconstruct(
            new Uuid($fair_evaluation->tweet_id),
            new Uuid($fair_evaluation->user_id),
            new TweetId($fair_evaluation->tweet_id)
        );
    }

    public function insert(FairEvaluation $FairEvaluation):?Uuid
    {
        $result = EMFairEvaluation::create([
            'id' => $FairEvaluation->id->value(),
            'user_id' => $FairEvaluation->user_id->value(),
            'slander_tweet_id' => $FairEvaluation->slander_tweet_id->value()
        ]);

        return isset($result['id']) ? new Uuid($result['id']) : null;
    }
}
