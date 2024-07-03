<?php

namespace App\Infrastructure\Repositories;

use App\Domains\Tettwi\Models\Slanderers\Slanderer;
use App\Domains\Tettwi\Shared\TwitterIcon;
use App\Domains\Tettwi\Shared\TwitterUsername;
use App\Domains\Tettwi\Shared\Uuid;
use App\Infrastructure\EloquentModels\EMSlanderer;

class SlandererRepository
{
    public function exists(TwitterUsername $twitter_username):bool
    {
        return EMSlanderer::where('twitter_username', $twitter_username->value())->exists();
    }
    public function find(Uuid $slanderer_id):?Slanderer
    {
        $slanderer = EMSlanderer::find($slanderer_id->value());

        if(is_null($slanderer)) return null;

        return Slanderer::reconstruct(
            new Uuid($slanderer->id),
            new TwitterUsername($slanderer->twitter_username),
            new TwitterIcon($slanderer->twitter_icon),
            $slanderer->regretted_at
        );
    }

    public function findByTwitterUsername(TwitterUsername $twitter_username):Slanderer
    {
        $slanderer = EMSlanderer::where('twitter_username', $twitter_username->value())->first();
        return Slanderer::reconstruct(
            new Uuid($slanderer->id),
            new TwitterUsername($slanderer->twitter_username),
            new TwitterIcon($slanderer->twitter_icon),
            $slanderer->regretted_at
        );
    }

    public function insert(Slanderer $Slanderer) : ?Uuid
    {
        $result = EMSlanderer::create([
           'id' => $Slanderer->id->value(),
           'twitter_username' => $Slanderer->twitter_username->value(),
           'twitter_icon' => $Slanderer->twitter_icon->value(),
           'regretted_at' => $Slanderer->regretted_at,
        ]);

        return isset($result['id']) ? new Uuid($result['id']) : null;
    }
}
