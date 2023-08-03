<?php

/**
 * This file is part of the "cashbox/foundation" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2023 Andrey Helldar
 * @license MIT
 *
 * @see https://cashbox.city
 */

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
