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
 * @see https://github.com/cashbox/foundation
 */

declare(strict_types=1);

namespace CashierProvider\Tinkoff\Credit\Responses;

use CashierProvider\Core\Http\ResponseInfo;

class Created extends ResponseInfo
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

    public function getStatus(): ?string
    {
        return 'NEW';
    }

    public function isEmpty(): bool
    {
        return empty($this->getExternalId()) || empty($this->getUrl());
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            self::KEY_STATUS => $this->getStatus(),
        ]);
    }
}
