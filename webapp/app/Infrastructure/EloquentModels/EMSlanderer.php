<?php

namespace App\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EMSlanderer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'slanderers';

    //これ書かないとcreateの戻り値のtwitter_idが0になる
    public $incrementing = false;

    protected $fillable = [
        'id',
        'twitter_username',
        'twitter_icon',
    ];
}
