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

use Cashbox\Core\Http\Response as BaseResponse;
use Cashbox\Core\Services\Driver as BaseDriver;
use Cashbox\Tinkoff\Credit\Http\Requests\CancelRequest;
use Cashbox\Tinkoff\Credit\Http\Requests\CommitRequest;
use Cashbox\Tinkoff\Credit\Http\Requests\CreateRequest;
use Cashbox\Tinkoff\Credit\Http\Requests\GetStateRequest;
use Cashbox\Tinkoff\Credit\Http\Responses\CreatedResponse;
use Cashbox\Tinkoff\Credit\Http\Responses\Response;
use Cashbox\Tinkoff\Credit\Services\Exception;
use Cashbox\Tinkoff\Credit\Services\Statuses;
use Illuminate\Support\Str;

class Driver extends BaseDriver
{
    protected string $statuses = Statuses::class;

    protected string $exception = Exception::class;

    protected string $response = Response::class;

    protected array $commitStatuses = [
        'signed',
        'issued',
    ];

    public function start(): BaseResponse
    {
        return $this->request(CreateRequest::class, CreatedResponse::class);
    }

    public function verify(): BaseResponse
    {
        $response = $this->request(GetStateRequest::class);

        if ($this->toCommit($response)) {
            return $this->request(CommitRequest::class);
        }

        return $response;
    }

    public function refund(): BaseResponse
    {
        return $this->request(CancelRequest::class);
    }

    protected function toCommit(BaseResponse $response): bool
    {
        return Str::contains((string) $response->status, $this->commitStatuses, true);
    }
}
