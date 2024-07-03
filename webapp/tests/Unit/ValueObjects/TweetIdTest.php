<?php

namespace Tests\Unit\ValueObjects;

use App\Domains\Tettwi\Shared\TweetId;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class TweetIdTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testConstruct(): void
    {
        $tweet_id_not_integer_str = '175766156498607725a';
        try{
            new TweetId($tweet_id_not_integer_str);
        }catch(\Exception $e){
            $this->assertTrue(true);
        } finally {
            $this->assertTrue(isset($e), 'No validation errors thrown');
        }

        $tweet_id_str = '1757661564986077252';
        $tweet_id = new TweetId($tweet_id_str);

        $this->assertEquals($tweet_id->value(), $tweet_id_str);

    }
}
