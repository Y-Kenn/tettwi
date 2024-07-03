<?php

namespace App\Application\ranking;

use App\Infrastructure\EloquentModels\EMSlanderousEvaluation;
use App\Infrastructure\EloquentModels\EMSlanderTweet;
use Carbon\Carbon;

class SlanderousTweetRankingQueryService
{
    public function getNewArrivalTweets():array
    {
        $now = Carbon::now();
        $yesterday = $now->subDay();

        $tweets = EMSlanderTweet::
            orderBy('created_at', 'desc')
            ->limit(10)
            ->get()->toArray();
        return $tweets;
    }

    public function getDailyRankingTweets():array
    {
        $now = Carbon::now();
        $yesterday = $now->subDay();
        $ranking = EMSlanderousEvaluation::where('created_at', '>', $yesterday)
            ->select('slander_tweet_id')
            ->selectRaw('COUNT(slander_tweet_id) as count_tweet_id')
            ->groupBy('slander_tweet_id')
            ->orderBy('count_tweet_id', 'desc')
            ->limit(10)
            ->get()->toArray();

        $tweet_ids = array_column($ranking, 'slander_tweet_id');

        $tweets = EMSlanderTweet::whereIn('tweet_id', $tweet_ids)
            ->get()->toArray();
        return $tweets;
    }

    public function getWeeklyRankingTweets():array
    {
        $now = Carbon::now();
        $last_week = $now->subDay(7);
        $ranking = EMSlanderousEvaluation::where('created_at', '>', $last_week)
            ->select('slander_tweet_id')
            ->selectRaw('COUNT(slander_tweet_id) as count_tweet_id')
            ->groupBy('slander_tweet_id')
            ->orderBy('count_tweet_id', 'desc')
            ->limit(10)
            ->get()->toArray();

        $tweet_ids = array_column($ranking, 'slander_tweet_id');

        $tweets = EMSlanderTweet::whereIn('tweet_id', $tweet_ids)
            ->get()->toArray();
        return $tweets;
    }
}
