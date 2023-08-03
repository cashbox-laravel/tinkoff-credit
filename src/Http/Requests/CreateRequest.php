<?php

declare(strict_types=1);

namespace Cashbox\Tinkoff\Credit\Http\Requests;

class CreateRequest extends BaseRequest
{
    protected string $productionUri = '/api/partners/v2/orders/create';

    protected ?string $devUri = '/api/partners/v2/orders/create-demo';

    protected bool $secure = false;

    public function body(): array
    {
        return array_merge([
            'shopId'     => $this->resource->shopId(),
            'showcaseId' => $this->resource->showCaseId(),

            'orderNumber' => $this->resource->paymentId(),
            'sum'         => $this->resource->sum(),

            'items' => $this->resource->productItems(),
        ], $this->userContact(), $this->promoCode());
    }

    protected function userContact(): array
    {
        if ($contact = $this->resource->contact()) {
            return ['values' => ['contact' => $contact]];
        }

        return [];
    }

    protected function promoCode(): array
    {
        if ($code = $this->resource->promoCode()) {
            return ['promoCode' => $code];
        }

        return [];
    }
}
