<?php

declare(strict_types=1);

namespace Cashbox\Tinkoff\Credit\Http\Responses;

use Spatie\LaravelData\Attributes\MapInputName;

class CreatedResponse extends Response
{
    public ?string $status = 'NEW';

    #[MapInputName('id')]
    public string $externalId;

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }
}
