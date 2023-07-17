<?php

declare(strict_types=1);

namespace Cashbox\Tinkoff\Credit\Http\Requests;

use Cashbox\Core\Enums\HttpMethodEnum;

class GetStateRequest extends BaseRequest
{
    public HttpMethodEnum $method = HttpMethodEnum::get;

    protected string $productionUri = '/api/partners/v2/orders/{orderNumber}/info';

    public function body(): array
    {
        return [];
    }
}
