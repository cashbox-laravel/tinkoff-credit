<?php

declare(strict_types=1);

namespace CashierProvider\Tinkoff\Credit\Requests;

class Init extends BaseRequest
{
    protected $path = '/api/partners/v2/orders/create';

    public function getRawBody(): array
    {
        return [
            'shopId'     => $this->model->getShopId(),
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
        $items = [];

        foreach ($this->model->getItems() as $item) {
            $items[] = [
                'name'     => $item->title,
                'quantity' => $item->quantity,
                'price'    => $item->price,
            ];
        }

        return $items;
    }
}
