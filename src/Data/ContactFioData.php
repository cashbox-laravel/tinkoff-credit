<?php

declare(strict_types=1);

namespace Cashbox\Tinkoff\Credit\Data;

use Spatie\LaravelData\Data;

class ContactFioData extends Data
{
    public string $lastName;

    public string $firstName;

    public string $middleName;
}
