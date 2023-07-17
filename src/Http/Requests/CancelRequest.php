<?php

declare(strict_types=1);

namespace Cashbox\Tinkoff\Credit\Http\Requests;

class CancelRequest extends BaseRequest
{
    protected string $productionUri = '/api/partners/v2/orders/{orderNumber}/cancel';

    public function body(): array
    {
        return [];
    }
}
