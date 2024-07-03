<?php

namespace App\Http\Controllers;

use App\Application\SlanderousEvaluation\FairEvaluationApplicationService;
use App\Domains\Tettwi\Models\SlanderousEvaluations\SlanderousEvaluation;
use App\Infrastructure\Repositories\SlanderousEvaluationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SlanderousEvaluationController extends Controller
{
    private readonly SlanderousEvaluationRepository $SlanderousEvaluationRepository;
    private readonly FairEvaluationApplicationService $SlanderousEvaluationAS;
    public function __construct()
    {
        $this->SlanderousEvaluationRepository = new SlanderousEvaluationRepository;
        $this->SlanderousEvaluationAS
            = new FairEvaluationApplicationService($this->SlanderousEvaluationRepository);
    }

    public function store(Request $request)
    {
       $result = $this->SlanderousEvaluationAS->register(
           user_id_primitive: Auth::id(),
           slander_tweet_id_primitive: $request->tweet_id
       );

       return (bool)$result;
    }

    public function destroy(Request $request)
    {
        $result = $this->SlanderousEvaluationAS->delete(
            user_id_primitive: Auth::id(),
            slander_tweet_id_primitive: $request->slander_tweet_id
        );

        return (bool)$result;
    }
}
