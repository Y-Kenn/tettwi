<?php

namespace App\Application\Bookmark;

use App\Domains\Tettwi\Models\Bookmarks\Bookmark;
use App\Domains\Tettwi\Models\SlanderousEvaluations\SlanderousEvaluation;
use App\Domains\Tettwi\Services\BookmarkService;
use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\Uuid;
use App\Infrastructure\Repositories\BookmarkRepository;
use Illuminate\Support\Facades\Log;

class BookmarkApplicationService
{
    private readonly BookmarkRepository $BookmarkRepository;
    private readonly BookmarkService $BookmarkService;

    public function __construct(BookmarkRepository $BookmarkRepository)
    {
        $this->BookmarkRepository = $BookmarkRepository;
        $this->BookmarkService
            = new BookmarkService($this->BookmarkRepository);
    }

    public function register(String $user_id_primitive, String $slander_tweet_id_primitive)
    {
        $slander_tweet_id = new TweetId($slander_tweet_id_primitive);
        $user_id = new Uuid($user_id_primitive);
        $exist_flag = $this->BookmarkService->exists( $slander_tweet_id, $user_id);
        Log::debug('EXIST FLAG : ' . print_r($exist_flag, true));
        if($exist_flag) return null;

        $Bookmark = Bookmark::create($slander_tweet_id, $user_id);
        $result = $this->BookmarkRepository->insert($Bookmark);
        Log::debug('RESULTl : ' . print_r($result, true));
        if(!$result) return null;

        return $result;
    }

    public function delete(String $user_id_primitive, String $slander_tweet_id_primitive)
    {
        $slander_tweet_id = new TweetId($slander_tweet_id_primitive);
        $user_id = new Uuid($user_id_primitive);
        $exist_flag = $this->BookmarkService->exists( $slander_tweet_id, $user_id);
        if($exist_flag) return null;

        $Bookmark = Bookmark::create($slander_tweet_id, $user_id);
        $result = $this->BookmarkRepository->insert($Bookmark);
        if(!$result) return null;

        return $result;
    }
}
