<?php

namespace App\Http\Controllers;

use App\Application\Bookmark\BookmarkApplicationService;
use App\Domains\Tettwi\Models\Bookmarks\Bookmark;
use App\Infrastructure\Repositories\BookmarkRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    private readonly BookmarkRepository $BookmarkRepository;
    private readonly BookmarkApplicationService $BookmarkAS;
    public function __construct()
    {
        $this->BookmarkRepository = new BookmarkRepository;
        $this->BookmarkAS
            = new BookmarkApplicationService($this->BookmarkRepository);
    }

    public function store(Request $request)
    {
       $result = $this->BookmarkAS->register(
           user_id_primitive: Auth::id(),
           slander_tweet_id_primitive: $request->tweet_id
       );

       return (bool)$result;
    }

    public function destroy(Request $request)
    {
        $result = $this->BookmarkAS->delete(
            user_id_primitive: Auth::id(),
            slander_tweet_id_primitive: $request->slander_tweet_id
        );

        return (bool)$result;
    }
}
