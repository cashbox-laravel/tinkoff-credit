<?php

declare(strict_types=1);

namespace Cashbox\Tinkoff\Credit\Http\Requests;

use Cashbox\Core\Http\Request;
use DragonCode\Support\Facades\Helpers\Str;

/**
 * @see https://www.tinkoff.ru/business/help/sales/loans/how-to-integrate/API/
 */
abstract class BaseRequest extends Request
{
    protected string $productionHost = 'https://forma.tinkoff.ru';

    public function url(): ?string
    {
        return Str::replaceFormat(parent::url(), [
            'orderNumber' => $this->resource->paymentId(),
        ], '{%s}');
    }

    public function options(): array
    {
        if ($this->hash) {
            return [
                'auth' => [
                    $this->clientId(),
                    $this->clientSecret(),
                ],
            ];
        }

        return [];
    }

    protected function clientId(): string
    {
        if (static::isProduction()) {
            return $this->resource->clientId();
        }

        return Str::start($this->resource->clientId(), 'demo-');
    }

    protected function clientSecret(): string
    {
        return $this->resource->clientSecret();
    }
}
