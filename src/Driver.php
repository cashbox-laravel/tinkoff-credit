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

namespace Cashbox\Tinkoff\Credit;

use Cashbox\Core\Http\Response as BaseInfoData;
use Cashbox\Core\Services\Driver as BaseDriver;
use Cashbox\Tinkoff\Credit\Http\Requests\CancelRequest;
use Cashbox\Tinkoff\Credit\Http\Requests\CreateRequest;
use Cashbox\Tinkoff\Credit\Http\Requests\GetStateRequest;
use Cashbox\Tinkoff\Credit\Http\Responses\Response;
use Cashbox\Tinkoff\Credit\Services\Exception;
use Cashbox\Tinkoff\Credit\Services\Statuses;

class Driver extends BaseDriver
{
    protected string $statuses = Statuses::class;

    protected string $exception = Exception::class;

    protected string $response = Response::class;

    public function start(): BaseInfoData
    {
        return $this->request(CreateRequest::class);
    }

    public function refund(): BaseInfoData
    {
        return $this->request(CancelRequest::class);
    }

    public function verify(): BaseInfoData
    {
        return $this->request(GetStateRequest::class);
    }
}
