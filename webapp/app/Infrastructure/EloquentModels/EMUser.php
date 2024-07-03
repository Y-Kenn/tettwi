<?php

namespace App\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class EMUser extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    use HasUuids;
    use SoftDeletes;

    protected  $table = 'users';

    protected $fillable = [
        'real_name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

}
