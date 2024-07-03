<?php

namespace App\Application\SlanderTweet\NewArrivalTweets;

use App\Infrastructure\EloquentModels\EMSlanderTweet;

class NewArrivalTweetsQueryService
{
    public function getNewArrivalTweets(
        int $limit_days_ago = 7,
        int $limit_result_num = 50
    )
    {
        $limit_date = date('Y-m-dTH:i:s', time() - 60*60*24*$limit_days_ago);
        $list = EMSlanderTweet::where('created_at' > $limit_date)
                                ->orderBy('created_at', 'desc')
                                ->limit($limit_result_num)
                                ->get()->toArray();

    }
}
