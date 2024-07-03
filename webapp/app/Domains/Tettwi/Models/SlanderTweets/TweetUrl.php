<?php

declare(strict_types=1);

namespace App\Domains\Tettwi\Models\SlanderTweets;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use MichaelRubel\ValueObjects\ValueObject;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @method static static make(mixed ...$values)
 * @method static static from(mixed ...$values)
 *
 * @extends ValueObject<TKey, TValue>
 */
class TweetUrl extends ValueObject
{
    private string $tweet_url;

    //Sample: https://twitter.com/elonmusk/status/1757224406210744717
    protected $rules = [
        'tweet_url' => 'required|string|url',
//        'tweet_url' => 'required|string|url|starts_with:https://twitter.com/regex:/status/',
    ];
    /**
     * Create a new instance of the value object.
     *
     * @return void
     */
    public function __construct($tweet_url)
    {
        $this->tweet_url = $tweet_url;
        $this->validate();
    }

    /**
     * Get the object value.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->tweet_url;
    }

    /**
     * Get array representation of the value object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'tweet_url' => $this->tweet_url
        ];
    }

    /**
     * Get string representation of the value object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->tweet_url;
    }

    /**
     * Validate the value object data.
     *
     * @return void
     */
    protected function validate(): void
    {
        $validator = Validator::make(
            $this->toArray(),
            $this->rules
        );
        $validator->validate();
    }
}
