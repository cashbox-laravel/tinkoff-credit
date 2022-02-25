<?php

namespace CashierProvider\Tinkoff\Credit\Requests;

class Confirm extends BaseRequest
{
    protected $path = '/api/partners/v2/orders/{orderNumber}/commit';

    public function getRawBody(): array
    {
        return [
            'orderNumber' => $this->model->getExternalId(),
        ];
    }
}
