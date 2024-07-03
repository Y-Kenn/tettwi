<?php

namespace App\Http\Controllers;

use App\Application\FairEvaluation\BookmarkApplicationService;
use App\Domains\Tettwi\Models\FairEvaluations\FairEvaluation;
use App\Infrastructure\Repositories\FairEvaluationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FairEvaluationController extends Controller
{
    private readonly FairEvaluationRepository $FairEvaluationRepository;
    private readonly BookmarkApplicationService $FairEvaluationAS;
    public function __construct()
    {
        $this->FairEvaluationRepository = new FairEvaluationRepository;
        $this->FairEvaluationAS
            = new BookmarkApplicationService($this->FairEvaluationRepository);
    }

    public function store(Request $request)
    {
       $result = $this->FairEvaluationAS->register(
           user_id_primitive: Auth::id(),
           slander_tweet_id_primitive: $request->tweet_id
       );

       return (bool)$result;
    }

    public function destroy(Request $request)
    {
        $result = $this->FairEvaluationAS->delete(
            user_id_primitive: Auth::id(),
            slander_tweet_id_primitive: $request->slander_tweet_id
        );

        return (bool)$result;
    }
}
