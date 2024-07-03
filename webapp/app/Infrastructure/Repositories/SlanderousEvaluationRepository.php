<?php

namespace App\Infrastructure\Repositories;


use App\Domains\Tettwi\Models\SlanderousEvaluations\SlanderousEvaluation;
use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\Uuid;
use App\Infrastructure\EloquentModels\EMSlanderousEvaluation;

class SlanderousEvaluationRepository
{
    public function exists(TweetId $tweet_id, Uuid $user_id):bool
    {
        return EMSlanderousEvaluation::where('slander_tweet_id', $tweet_id->value())
                                        ->where('user_id', $user_id->value())
                                        ->exists();
    }
    public function find(Uuid $id):?SlanderousEvaluation
    {
        $slanderous_evaluation = EMSlanderousEvaluation::find($id->value());

        if(is_null($slanderous_evaluation)) return null;

        return SlanderousEvaluation::reconstruct(
            new Uuid($slanderous_evaluation->tweet_id),
            new TweetId($slanderous_evaluation->tweet_id),
            new Uuid($slanderous_evaluation->user_id)
        );
    }

    public function insert(SlanderousEvaluation $SlanderousEvaluation):?Uuid
    {
        $result = EMSlanderousEvaluation::create([
            'id' => $SlanderousEvaluation->id->value(),
            'slander_tweet_id' => $SlanderousEvaluation->slander_tweet_id->value(),
            'user_id' => $SlanderousEvaluation->user_id->value()
        ]);

        return isset($result['id']) ? new Uuid($result['id']) : null;
    }

    public function delete(Uuid $slanderous_evaluation_id):?int
    {
        $result = EMSlanderousEvaluation::find($slanderous_evaluation_id.value())
            ->delete();

        return isset($result['id']) ? $result : null;
    }
}
