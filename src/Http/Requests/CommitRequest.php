<?php

declare(strict_types=1);

namespace Cashbox\Tinkoff\Credit\Http\Requests;

use Cashbox\Core\Enums\HttpMethodEnum;

class CommitRequest extends BaseRequest
{
    protected string $productionUri = '/api/partners/v2/orders/{orderNumber}/commit';

    public function body(): array
    {
        return [];
    }
}
