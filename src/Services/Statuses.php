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
 * @see https://github.com/cashbox-laravel/foundation
 */

namespace Cashbox\Tinkoff\Credit\Services;

use Cashbox\Core\Services\Statuses as BaseStatus;

class Statuses extends BaseStatus
{
    public const FAILED    = ['REJECTED'];
    public const NEW       = ['NEW'];
    public const REFUNDED  = ['CANCELED'];
    public const REFUNDING = [];
    public const SUCCESS   = ['APPROVED'];
}
