<?php

declare(strict_types=1);

namespace App\Domains\Tettwi\Shared;

use Illuminate\Support\Str;
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
class Uuid extends ValueObject
{
    private string $uuid;

    protected $rules = [
        "uuid" => "required|regex:/([0-9a-f]{8})-([0-9a-f]{4})-([0-9a-f]{4})-([0-9a-f]{4})-([0-9a-f]{12})/"
    ];

    /**
     * Create a new instance of the value object.
     *
     * @return void
     */
    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
        $this->validate();
    }

    public static function generate():Uuid
    {
        return new self(Str::uuid()->toString());
    }

    /**
     * Get the object value.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->uuid;
    }

    /**
     * Get array representation of the value object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            "uuid" => $this->uuid
        ];
    }

    /**
     * Get string representation of the value object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->uuid;
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
