<?php

declare(strict_types=1);

namespace Cashbox\Tinkoff\Credit\Http\Resources;

use Cashbox\Core\Data\Models\InfoData;
use Cashbox\Core\Http\Response as BaseData;

class Response extends BaseData
{
    public ?string $status;

    public ?string $url;

    public function getOperationId(): ?string
    {
        return null;
    }

    public function getInfo(): InfoData
    {
        return InfoData::from([
            'externalId'  => $this->getExternalId(),
            'operationId' => $this->getOperationId(),
            'status'      => $this->getStatus(),
            'extra'       => $this->getExtra(),
        ]);
    }

    protected function getExtra(): ?array
    {
        return [
            'url' => $this->url,
        ];
    }

    protected function getStatus(): ?string
    {
        return $this->status;
    }
}
