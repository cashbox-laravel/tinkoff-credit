<?php

declare(strict_types=1);

namespace Cashbox\Tinkoff\Credit\Resources;

use Cashbox\Core\Resources\Resource;
use Cashbox\Tinkoff\Credit\Data\ContactData;
use Cashbox\Tinkoff\Credit\Data\ProductData;

abstract class TinkoffCreditResource extends Resource
{
    /**
     * @return array<ProductData>
     */
    abstract public function products(): array;

    abstract public function shopId(): string;

    public function showCaseId(): ?string
    {
        return null;
    }

    public function promoCode(): ?string
    {
        return null;
    }

    public function contact(): ?ContactData
    {
        return null;
    }
}
