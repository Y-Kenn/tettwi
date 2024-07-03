<?php

namespace App\Application\SlanderTweet\RegisterSlanderTweet;

use App\Domains\Tettwi\Models\Slanderers\Slanderer;
use App\Domains\Tettwi\Models\SlanderTweets\EmbeddedTweet;
use App\Domains\Tettwi\Models\SlanderTweets\SlanderTweet;
use App\Domains\Tettwi\Models\SlanderTweets\TweetUrl;
use App\Domains\Tettwi\Services\SlandererService;
use App\Domains\Tettwi\Services\SlanderTweetService;
use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\TwitterIcon;
use App\Domains\Tettwi\Shared\TwitterUsername;
use App\Domains\Tettwi\Shared\Uuid;
use App\Infrastructure\Repositories\SlandererRepository;
use App\Infrastructure\Repositories\SlanderTweetRepository;
use Illuminate\Support\Facades\Log;

class RegisterSlanderTweetApplicationService
{
    private readonly SlandererRepository $SlandererRepository;
    private readonly SlanderTweetRepository $SlanderTweetRepository;
    private readonly SlandererService $SlandererService;
    private readonly SlanderTweetService $SlanderTweetService;

    public function __construct(
        SlandererRepository $SlandererRepository,
        SlanderTweetRepository $SlanderTweetRepository
    ){
        $this->SlandererRepository = $SlandererRepository;
        $this->SlanderTweetRepository = $SlanderTweetRepository;
        $this->SlandererService = new SlandererService($SlandererRepository);
        $this->SlanderTweetService = new SlanderTweetService($SlanderTweetRepository);
    }

    public function register(string $tweet_url_primitive, string $user_id_primitive)
    {
        $tweet_url = new TweetUrl($tweet_url_primitive);
        $user_id = new Uuid($user_id_primitive);
        $tweet_id = $this->extractTweetIdFromUrl($tweet_url);
        $twitter_username = $this->extractTwitterUsernameFromUrl($tweet_url);
        $twitter_icon = $this->makeIconUrl($tweet_url);

        $exists_tweet_flag = $this->SlanderTweetService->exists($tweet_id);
        if($exists_tweet_flag) return null;

        // slanderer_idの取得
        $exist_slanderer_flag = $this->SlandererService->exists($twitter_username);
        if(!$exist_slanderer_flag){
            $Slanderer = Slanderer::create($twitter_username, $twitter_icon);
            $slanderer_id = $this->SlandererRepository->insert($Slanderer);
        }else{
            $Slanderer = $this->SlandererRepository->findByTwitterUsername($twitter_username);
            $slanderer_id = $Slanderer->id;
        }

        $embedded_tweet = $this->getEmbeddedTweet($tweet_url);

        $SlanderTweet = SlanderTweet::create($tweet_id, $user_id, $slanderer_id, $embedded_tweet);
        $result = $this->SlanderTweetRepository->insert($SlanderTweet);
        // TODO:ハンドリング
        if(!$result) return null;

        return $embedded_tweet->value();
    }

    private function getEmbeddedTweet(string $tweet_url_str):EmbeddedTweet
    {
        $tweet_url = new TweetUrl($tweet_url_str);
        return $this->requestToTwitterEmbedded($tweet_url);
    }

    private function requestToTwitterEmbedded(TweetUrl $tweet_url):EmbeddedTweet
    {
        $get_http_url = 'https://publish.twitter.com/oembed?url=' .$tweet_url->value();
        $get_curl = curl_init();
        curl_setopt($get_curl, CURLOPT_URL, $get_http_url); // url-setting
        curl_setopt($get_curl, CURLOPT_CUSTOMREQUEST, "GET"); // メソッド指定 Ver. GET
        curl_setopt($get_curl, CURLOPT_HTTPHEADER, array("Content-type: application/json")); // HTTP-HeaderをSetting
        curl_setopt($get_curl, CURLOPT_SSL_VERIFYPEER, false); // サーバ証明書の検証は行わない。
        curl_setopt($get_curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($get_curl, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列で受け取る
        $response = json_decode(curl_exec($get_curl));
        curl_close($get_curl);
        if(isset($response->errors)) {
            // TODO:エラーハンドリング
            Log::debug('has error');
        }
        return new EmbeddedTweet($response->html);
    }

    private function extractTweetIdFromUrl(TweetUrl $tweet_url):TweetId
    {
        $path_array = explode('/',$tweet_url->value());
        return new TweetId($path_array[5]);
    }

    private function extractTwitterUsernameFromUrl(TweetUrl $tweet_url):TwitterUsername
    {
        $path_array = explode('/',$tweet_url->value());
        return new TwitterUsername($path_array[3]);
    }

    // 戻り値の例 : https://twitter.com/Colonel_Akane/photo
    private function makeIconUrl(TweetUrl $tweet_url):TwitterIcon
    {
        $path_array = explode('/',$tweet_url->value());
        $icon_url = '';
        for($i = 0; $i <= 3; $i++){
            $icon_url .= $path_array[$i] . '/';
        }
        $icon_url .= 'photo';
        return new TwitterIcon($icon_url);
    }

}
