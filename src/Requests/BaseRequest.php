<?php

declare(strict_types=1);

namespace CashierProvider\Tinkoff\Credit\Requests;

use CashierProvider\Core\Facades\Config\Main;
use CashierProvider\Core\Http\Request;
use Lmc\HttpConstants\Header;

abstract class BaseRequest extends Request
{
    protected $production_host = 'https://forma.tinkoff.ru';

    protected $dev_host = 'https://forma.tinkoff.ru';

    protected $headers = [
        Header::ACCEPT       => 'application/json',
        Header::CONTENT_TYPE => 'application/json',
    ];

    public function getRawHeaders(): array
    {
        return $this->hash ? array_merge($this->headers, $this->getAuthHeaders()) : $this->headers;
    }

    protected function getAuthHeaders(): array
    {
        return [
            Header::AUTHORIZATION => 'Basic ' . $this->model->getClientId() . ':' . $this->model->getClientSecret(),
            //Header::AUTHORIZATION => 'Basic ' . base64_encode($this->model->getClientId() . ':' . $this->model->getClientSecret()),
        ];
    }

    protected function getPath(): ?string
    {
        return str_replace('{orderNumber}', $this->model->getExternalId(), $this->getUri());
    }

    protected function getUri(): string
    {
        if (Main::isProduction()) {
            return $this->path;
        }

        return $this->path_dev ?? $this->path;
    }
}
