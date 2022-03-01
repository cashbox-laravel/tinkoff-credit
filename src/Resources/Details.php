<?php

declare(strict_types=1);

namespace CashierProvider\Tinkoff\Credit\Resources;

use CashierProvider\Core\Resources\Details as BaseDetails;
use DragonCode\Support\Facades\Http\Builder;
use Illuminate\Support\Arr;

class Details extends BaseDetails
{
    protected $url;

    protected $token;

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getToken(): ?string
    {
        if ($url = $this->getUrl()) {
            $params = Builder::parse($url)->getQueryArray();

            return Arr::get($params, 'values');
        }

        return $this->token;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'url'    => $this->url,
            'token'  => $this->token,
        ];
    }
}
