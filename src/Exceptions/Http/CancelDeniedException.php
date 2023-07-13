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

namespace Cashbox\Tinkoff\Credit\Exceptions\Http;

use Cashbox\Core\Exceptions\Http\BaseException;

class CancelDeniedException extends BaseException
{
    protected $status_code = 403;

    protected $reason = 'Payment not found';
}
