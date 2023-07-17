<?php

declare(strict_types=1);

namespace Cashbox\Tinkoff\Credit\Data;

use Cashbox\Tinkoff\Credit\Data\Casts\PhoneCast;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class ContactData extends Data
{
    public ContactFioData $fio;

    #[WithCast(PhoneCast::class)]
    public ?string $mobilePhone;

    public ?string $email;
}
