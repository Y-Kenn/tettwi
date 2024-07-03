<?php

declare(strict_types=1);

namespace App\Domains\Tettwi\Models\Users;

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
class UserId extends ValueObject
{
    private string $user_id;

    protected $rules = [
        "user_id" => "required"
    ];

    /**
     * Create a new instance of the value object.
     *
     * @return void
     */
    public function __construct(string $user_id)
    {
        $this->user_id = $user_id;
        $this->validate();
    }

    /**
     * Get the object value.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->user_id;
    }

    /**
     * Get array representation of the value object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            "user_id" => $this->user_id
        ];
    }

    /**
     * Get string representation of the value object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->user_id;
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
