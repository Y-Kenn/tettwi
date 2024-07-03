<?php

namespace App\Http\Controllers;

use App\Application\ranking\SlanderousTweetRankingApplicationService;
use App\Infrastructure\Repositories\SlanderousEvaluationRepository;
use App\Infrastructure\Repositories\SlanderTweetRepository;

class SlanderousTweetRankingController
{
    private readonly SlanderTweetRepository $SlanderTweetRepository;
    private readonly SlanderousEvaluationRepository $SlanderousEvaluationRepository;

    private readonly SlanderousTweetRankingApplicationService $SlanderousTweetRankingAS;
    public function __construct()
    {
        $this->SlanderTweetRepository = new SlanderTweetRepository;
        $this->SlanderousEvaluationRepository = new SlanderousEvaluationRepository;
        $this->SlanderousTweetRankingAS = new SlanderousTweetRankingApplicationService(
            $this->SlanderTweetRepository,
            $this->SlanderousEvaluationRepository
        );
    }

    public function index()
    {
        $new_arrival_tweets =  $this->SlanderousTweetRankingAS->getNewArrivalTweets();
        $daily_ranking_tweets =  $this->SlanderousTweetRankingAS->getDailyRankingTweets();
        $weekly_ranking_tweets =  $this->SlanderousTweetRankingAS->getWeeklyRankingTweets();

        return view('pages.ranking.index',[
            'new_arrival_tweets' => $new_arrival_tweets,
            'daily_ranking_tweets' => $daily_ranking_tweets,
            'weekly_ranking_tweets' => $weekly_ranking_tweets
        ]);
    }
}
