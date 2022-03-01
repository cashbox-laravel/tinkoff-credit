<?php

declare(strict_types=1);

namespace CashierProvider\Tinkoff\Credit\Responses;

use CashierProvider\Core\Http\Response;

class Created extends Response
{
    public const KEY_URL = 'url';

    protected $map = [
        self::KEY_EXTERNAL_ID => 'id',

        self::KEY_URL => 'link',
    ];

    public function getUrl(): ?string
    {
        return $this->value(self::KEY_URL);
    }

    public function isEmpty(): bool
    {
        return empty($this->getExternalId()) || empty($this->getUrl());
    }
}
