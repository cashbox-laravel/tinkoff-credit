<?php

declare(strict_types=1);

namespace Cashbox\Tinkoff\Credit\Http\Requests;

class CreateRequest extends BaseRequest
{
    protected string $productionUri = '/api/partners/v2/orders/create';

    protected ?string $devUri = '/api/partners/v2/orders/create-demo';

    protected bool $hash = false;

    public function body(): array
    {
        return [
            'shopId'     => $this->resource->clientId(),
            'showcaseId' => $this->resource->showcaseId(),
            'promoCode'  => $this->resource->promoCode(),

            'orderNumber' => $this->resource->paymentId(),
            'sum'         => $this->resource->sum(),

            'values' => [
                'contact' => [
                    'lastName'   => $this->resource->lastName(),
                    'firstName'  => $this->resource->firstName(),
                    'middleName' => $this->resource->middleName(),
                ],

                'mobilePhone' => $this->resource->phone(),
                'email'       => $this->resource->email(),
            ],

            'items' => $this->resource->items(),
        ];
    }
}
