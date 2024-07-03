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
class TwitterIcon extends ValueObject
{
    private string $twitter_icon;

    protected $rules = [
        "twitter_icon" => "required|string"
    ];

    /**
     * Create a new instance of the value object.
     *
     * @return void
     */
    public function __construct(string $twitter_icon)
    {
        $this->twitter_icon = $twitter_icon;
        $this->validate();
    }

    /**
     * Get the object value.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->twitter_icon;
    }

    /**
     * Get array representation of the value object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'twitter_icon' => $this->twitter_icon
        ];
    }

    /**
     * Get string representation of the value object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->twitter_icon;
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
