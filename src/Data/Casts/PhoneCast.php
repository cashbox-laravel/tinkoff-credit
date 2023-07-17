<?php

declare(strict_types=1);

namespace Cashbox\Tinkoff\Credit\Data\Casts;

use DragonCode\Support\Facades\Helpers\Str;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class PhoneCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $context): ?string
    {
        if (empty($value)) {
            return null;
        }

        return Str::of($value)
            ->ltrim('+7')
            ->pregReplace('/\D/', '')
            ->toString();
    }
}
