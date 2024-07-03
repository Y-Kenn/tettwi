<?php

declare(strict_types=1);

namespace App\ValueObjects;

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
class Email extends ValueObject
{
    private String $email;
    protected $rules = [
        'email' => 'required|min:3|max:20'
    ];

    /**
     * Create a new instance of the value object.
     *
     * @return void
     */
    public function __construct()
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
        // TODO: Implement value() method.
    }

    /**
     * Get array representation of the value object.
     *
     * @return array
     */
    public function toArray(): array
    {
        // TODO: Implement value() method.
    }

    /**
     * Get string representation of the value object.
     *
     * @return string
     */
    public function __toString(): string
    {
        // TODO: Implement value() method.
    }

    /**
     * Validate the value object data.
     *
     * @return void
     */
    protected function validate(): void
    {
        // TODO: Implement validate() method.

        if ($this->value() === '') {
            throw ValidationException::withMessages(['Value of Email cannot be empty.']);
        }
    }
}
