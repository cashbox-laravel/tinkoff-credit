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

namespace CashierProvider\Tinkoff\Credit\Requests;

use Fig\Http\Message\RequestMethodInterface;

class GetState extends BaseRequest
{
    protected $method = RequestMethodInterface::METHOD_GET;

    protected $path = '/api/partners/v2/orders/{orderNumber}/info';

    public function getRawBody(): array
    {
        return [];
    }
}
