<?php

namespace App\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EMSlanderTweet extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'slander_tweets';

    protected $primaryKey = 'tweet_id';

    //これ書かないとcreateの戻り値が0になる
    public $incrementing = false;

    protected $fillable = [
        'tweet_id',
        'user_id',
        'slanderer_id',
        'embedded_tweet_html',
        'hidden_at',
        'tweeted_at',
    ];
}
