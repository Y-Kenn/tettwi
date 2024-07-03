<?php

namespace App\Infrastructure\Repositories;


use App\Domains\Tettwi\Models\Bookmarks\Bookmark;
use App\Domains\Tettwi\Shared\TweetId;
use App\Domains\Tettwi\Shared\Uuid;
use App\Infrastructure\EloquentModels\EMBookmark;

class BookmarkRepository
{
    public function exists(TweetId $tweet_id, Uuid $user_id):bool
    {
        return EMBookmark::where('slander_tweet_id', $tweet_id->value())
                                        ->where('user_id', $user_id->value())
                                        ->exists();
    }
    public function find(Uuid $id):?Bookmark
    {
        $bookmark = EMBookmark::find($id->value());

        if(is_null($bookmark)) return null;

        return Bookmark::reconstruct(
            new Uuid($bookmark->tweet_id),
            new Uuid($bookmark->user_id),
            new TweetId($bookmark->tweet_id)
        );
    }

    public function insert(Bookmark $Bookmark):?Uuid
    {
        $result = EMBookmark::create([
            'id' => $Bookmark->id->value(),
            'user_id' => $Bookmark->user_id->value(),
            'slander_tweet_id' => $Bookmark->slander_tweet_id->value()
        ]);

        return isset($result['id']) ? new Uuid($result['id']) : null;
    }
}
