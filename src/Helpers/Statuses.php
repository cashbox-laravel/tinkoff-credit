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

namespace CashierProvider\Tinkoff\Credit\Helpers;

use CashierProvider\Core\Services\Statuses as BaseStatus;

class Statuses extends BaseStatus
{
    public const NEW = [
        'NEW',
    ];
    public const REFUNDING = [];
    public const REFUNDED  = [
        'CANCELED',
    ];
    public const FAILED = [
        'REJECTED',
    ];
    public const SUCCESS = [
        'APPROVED',
    ];
}
