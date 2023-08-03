<?php

/**
 * This file is part of the "cashbox/foundation" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2023 Andrey Helldar
 * @license MIT
 *
 * @see https://cashbox.city
 */

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
