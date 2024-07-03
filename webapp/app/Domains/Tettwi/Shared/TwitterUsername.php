<?php

declare(strict_types=1);

namespace App\Domains\Tettwi\Shared;

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
class TwitterUsername extends ValueObject
{
    private string $twitter_username;

    protected $rules = [
        'twitter_username' => 'required|string'
    ];
    /**
     * Create a new instance of the value object.
     *
     * @return void
     */
    public function __construct(string $twitter_username)
    {
        $this->twitter_username = $twitter_username;
        $this->validate();
    }

    /**
     * Get the object value.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->twitter_username;
    }

    /**
     * Get array representation of the value object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'twitter_username' => $this->twitter_username
        ];
    }

    /**
     * Get string representation of the value object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->twitter_username;
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
