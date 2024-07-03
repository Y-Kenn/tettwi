<?php

namespace App\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EMSlanderousEvaluation extends Model
{
    use HasFactory;

    protected $table = 'slanderous_evaluations';

    //これ書かないとcreateの戻り値のidが0になる
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'slander_tweet_id',
    ];
}
