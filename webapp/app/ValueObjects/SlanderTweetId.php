<?php

declare(strict_types=1);

namespace App\ValueObjects;

use MichaelRubel\ValueObjects\ValueObject;
use Illuminate\Support\Facades\Validator;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @method static static make(mixed ...$values)
 * @method static static from(mixed ...$values)
 *
 * @extends ValueObject<TKey, TValue>
 */
class SlanderTweetId extends ValueObject
{
    private string $slander_tweet_id;

    protected $rules = [
        "slander_tweet_id" => "required|string",
    ];

    /**
     * Create a new instance of the value object.
     *
     * @return void
     */
    public function __construct(string $slander_tweet_id)
    {
        $this->slander_tweet_id = $slander_tweet_id;
        $this->validate();
    }

    /**
     * Get the object value.
     *
     * @return string
     */
    public function value(): string
    {
        $this->slander_tweet_id;
    }

    /**
     * Get array representation of the value object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'slander_tweet_id' => $this->slander_tweet_id,
        ];
    }

    /**
     * Get string representation of the value object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->slander_tweet_id;
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
