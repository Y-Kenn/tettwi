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
class EmbeddedTweet extends ValueObject
{
    private string $embedded_tweet;

    protected $rules = [
        "embedded_tweet" => "required|string|min:200"
    ];

    /**
     * Create a new instance of the value object.
     *
     * @return void
     */
    public function __construct($embedded_tweet)
    {
        $this->embedded_tweet = $embedded_tweet;
        $this->validate();
    }

    /**
     * Get the object value.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->embedded_tweet;
    }

    /**
     * Get array representation of the value object.
     *
     * @return array
     */
    public function toArray(): array
    {
       return [
           'embedded_tweet' => $this->embedded_tweet
       ];
    }

    /**
     * Get string representation of the value object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->embedded_tweet;
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
