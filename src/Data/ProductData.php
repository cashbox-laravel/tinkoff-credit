<?php

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
