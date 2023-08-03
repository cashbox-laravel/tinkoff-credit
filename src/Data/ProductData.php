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

use Spatie\LaravelData\Data;

class ProductData extends Data
{
    public string $name;

    public string $quantity;

    public string $price;

    public ?string $category;

    public ?string $vendorCode;
}
