<?php

declare(strict_types=1);

namespace App\Domains\Tettwi\Shared;

use Illuminate\Support\Facades\Log;
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
class TweetId extends ValueObject
{
    protected $rules = [
        'tweet_id' => 'required|string|integer|digits_between:10,20'
    ];
    /**
     * Create a new instance of the value object.
     *
     * @return void
     */
    public function __construct(private string $tweet_id)
    {
        $this->validate();
    }

    /**
     * Get the object value.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->tweet_id;
    }

    /**
     * Get array representation of the value object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
           'tweet_id' => $this->tweet_id
        ];
    }

    /**
     * Get string representation of the value object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->tweet_id;
    }

    /**
     * Validate the value object data.
     *
     * @return void
     */
    protected function validate(): void
    {
        Log::debug('test');
//        try {
            $validator = Validator::make(
                $this->toArray(),
                $this->rules
            );
            $validator->validate();
            Log::debug('test2');
//        }catch (\Exception $e){
//            Log::debug('Message : ' . print_r($e->getMessage(), true));
//        }

    }
}
