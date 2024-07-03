<?php

namespace App\Http\Controllers;

use App\Application\SlanderTweet\GetMySlanderTweets\GetMySlanderTweetsApplicationService;
use App\Application\SlanderTweet\RegisterSlanderTweet\RegisterSlanderTweetApplicationService;
use App\Infrastructure\Repositories\SlandererRepository;
use App\Infrastructure\Repositories\SlanderTweetRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PersonalSlanderTweetController extends Controller
{
    private readonly SlandererRepository $SlandererRepository;
    private readonly SlanderTweetRepository $SlanderTweetRepository;

    public function __construct()
    {
        $this->SlandererRepository = new SlandererRepository;
        $this->SlanderTweetRepository = new SlanderTweetRepository;
    }

    public function index()
    {
        $GetMySlanderTweetsAS = new GetMySlanderTweetsApplicationService();
        $my_slander_tweets = $GetMySlanderTweetsAS->getMySlanderTweets(Auth::id());
        Log::debug('My Slander Tweets : ' . print_r($my_slander_tweets, true));
        $my_slander_tweets2 = array_reverse($my_slander_tweets);
        return view('pages.mypage.my-tweets.index',[
            'my_slander_tweets' => $my_slander_tweets
        ]);
//        return $my_slander_tweets;
    }

    public function store(Request $request){

        $RegisterSlanderTweetAS = new RegisterSlanderTweetApplicationService(
            $this->SlandererRepository,
            $this->SlanderTweetRepository
        );
        Log::debug($request->slander_tweet_url);
        $embedded_tweet = $RegisterSlanderTweetAS->register($request->slander_tweet_url, Auth::id());

        $message = $embedded_tweet ? '登録しました' : 'すでに登録されています';
        return redirect()->route('my-tweets.index')->with('message', $message);
    }
}
