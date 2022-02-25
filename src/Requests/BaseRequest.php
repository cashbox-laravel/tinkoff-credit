<?php

declare(strict_types=1);

namespace CashierProvider\Tinkoff\Credit\Requests;

use CashierProvider\Core\Http\Request;

abstract class BaseRequest extends Request
{
    protected $production_host = 'https://forma.tinkoff.ru';

    protected $dev_host = 'https://forma.tinkoff.ru';

    public function getRawHeaders(): array
    {
        return [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    protected function getPath(): ?string
    {
        return str_replace('{orderNumber}', $this->model->getExternalId(), $this->path);
    }
}
