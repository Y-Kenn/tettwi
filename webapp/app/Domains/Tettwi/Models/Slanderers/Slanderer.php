<?php

namespace App\Domains\Tettwi\Models\Slanderers;



use App\Domains\Tettwi\Shared\TwitterIcon;
use App\Domains\Tettwi\Shared\TwitterUsername;
use App\Domains\Tettwi\Shared\Uuid;

class Slanderer
{
    private function __construct(
        public readonly ?Uuid           $id,
        public readonly TwitterUsername $twitter_username,
        public readonly ?TwitterIcon    $twitter_icon,
        public readonly ?string         $regretted_at
    ){}

    public static function create(
        TwitterUsername $twitter_username,
        ?TwitterIcon $twitter_icon = null
    ):Slanderer
    {
        $id = Uuid::generate();
        return new self($id, $twitter_username, $twitter_icon, null);
    }

    public static function reconstruct(
        Uuid            $id,
        TwitterUsername $twitter_username,
        TwitterIcon     $twitter_icon,
        ?string         $regretted_at = null
    ):Slanderer
    {
        return new self($id, $twitter_username, $twitter_icon, $regretted_at);
    }

    public function changeTwitterUsername()
    {

    }

}
