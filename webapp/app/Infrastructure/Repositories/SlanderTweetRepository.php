<?php

namespace App\Infrastructure\Repositories;


use App\Domains\Tettwi\Models\SlanderTweets\EmbeddedTweet;
use App\Domains\Tettwi\Models\SlanderTweets\SlanderTweet;
use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\Uuid;
use App\Infrastructure\EloquentModels\EMSlanderTweet;
use Illuminate\Support\Facades\Log;

class SlanderTweetRepository
{
    public function exists(TweetId $tweet_id):bool
    {
        return EMSlanderTweet::where('tweet_id', $tweet_id->value())->exists();
    }
    public function find(TweetId $tweet_id):?SlanderTweet
    {
        $SlanderTweet = EMSlanderTweet::find($tweet_id->value());

        if(is_null($SlanderTweet)) return null;

        return SlanderTweet::reconstruct(
            new TweetId($SlanderTweet->tweet_id),
            new Uuid($SlanderTweet->user_id),
            new Uuid($SlanderTweet->slanderer_id),
            new EmbeddedTweet($SlanderTweet->embedded_tweet),
            $SlanderTweet->slanderous_evaluations_num,
            $SlanderTweet->fair_evaluations_num,
            $SlanderTweet->bookmarks_num,
            $SlanderTweet->tweeted_at,
            $SlanderTweet->hidden_at
        );
    }

    public function insert(SlanderTweet $SlanderTweet):?TweetId
    {
        $result = EMSlanderTweet::create([
            'tweet_id' => $SlanderTweet->tweet_id->value(),
            'user_id' => $SlanderTweet->user_id->value(),
            'slanderer_id' => $SlanderTweet->slanderer_id->value(),
            'embedded_tweet_html' => $SlanderTweet->embedded_tweet->value(),
            'slanderous_evaluations_num' => $SlanderTweet->slanderous_evaluations_num,
            'fair_evaluations_num' => $SlanderTweet->fair_evaluations_num,
            'bookmarks_num' => $SlanderTweet->bookmarks_num,
            'tweeted_at' => $SlanderTweet->tweeted_at,
            'hidden_at' => $SlanderTweet->hidden_at,
        ]);

        return isset($result['tweet_id']) ? new TweetId($result['tweet_id']) : null;
    }
}
