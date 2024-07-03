<?php

namespace App\Http\Controllers;

use App\Infrastructure\Repositories\SlandererRepository;
use App\Infrastructure\Repositories\SlanderTweetRepository;
use Illuminate\Http\Request;

class TweetFeedController extends Controller
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

    }
}
