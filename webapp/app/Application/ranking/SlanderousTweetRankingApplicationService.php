<?php

namespace App\Application\ranking;

use App\Infrastructure\Repositories\SlanderousEvaluationRepository;
use App\Infrastructure\Repositories\SlanderTweetRepository;

class SlanderousTweetRankingApplicationService
{
    private readonly SlanderTweetRepository $SlanderTweetRepository;
    private readonly SlanderousEvaluationRepository $SlanderousEvaluationRepository;
    private readonly SlanderousTweetRankingQueryService $SlanderousTweetRankQS;
    public function __construct(
        SlanderTweetRepository $SlanderTweetRepository,
        SlanderousEvaluationRepository $SlanderousEvaluationRepository
    ){
        $this->SlanderTweetRepository = new SlanderTweetRepository;
        $this->SlanderousEvaluationRepository = new SlanderousEvaluationRepository;
        $this->SlanderousTweetRankQS = new SlanderousTweetRankingQueryService();
    }

    public function getNewArrivalTweets():array
    {
        return  $this->SlanderousTweetRankQS->getNewArrivalTweets();
    }

    public function getDailyRankingTweets():array
    {
        return  $this->SlanderousTweetRankQS->getDailyRankingTweets();
    }

    public function getWeeklyRankingTweets():array
    {
        return  $this->SlanderousTweetRankQS->getWeeklyRankingTweets();
    }
}
