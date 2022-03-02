<?php

declare(strict_types=1);

namespace CashierProvider\Tinkoff\Credit\Requests;

use Illuminate\Support\Arr;

class Init extends BaseRequest
{
    protected $path = '/api/partners/v2/orders/create';

    protected $path_dev = '/api/partners/v2/orders/create-demo';

    protected $hash = false;

    public function getRawBody(): array
    {
        return [
            'shopId'     => $this->model->getClientId(),
            'showcaseId' => $this->model->getShowCaseId(),
            'promoCode'  => $this->model->getPromoCode(),

            'sum' => $this->model->getSum(),

            'orderNumber' => $this->model->getPaymentId(),

            'values' => [
                'contact' => [
                    'fio' => [
                        'lastName'   => $this->model->getClient()->last_name,
                        'firstName'  => $this->model->getClient()->first_name,
                        'middleName' => $this->model->getClient()->middle_name,
                    ],

                    'mobilePhone' => $this->model->getClient()->phone,
                    'email'       => $this->model->getClient()->email,
                ],
            ],

            'items' => $this->getItems(),
        ];
    }

    protected function getItems(): array
    {
        return array_map(static function ($item) {
            $price = Arr::get($item, 'price', 0);

            Arr::set($item, 'price', (int) $price);

            return $item;
        }, $this->model->getItems()->each->only(['name', 'quantity', 'price'])->toArray());
    }

    protected function getPath(): ?string
    {
        return $this->getUri();
    }
}
