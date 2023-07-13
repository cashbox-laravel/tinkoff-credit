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

use Cashbox\Core\Services\Driver as BaseDriver;
use Cashbox\Tinkoff\Credit\Exceptions\Manager;
use Cashbox\Tinkoff\Credit\Helpers\Statuses;
use Cashbox\Tinkoff\Credit\Requests\Cancel;
use Cashbox\Tinkoff\Credit\Requests\GetState;
use Cashbox\Tinkoff\Credit\Requests\Init;
use Cashbox\Tinkoff\Credit\Resources\Details;
use Cashbox\Tinkoff\Credit\Responses\Created;
use Cashbox\Tinkoff\Credit\Responses\Refund;
use Cashbox\Tinkoff\Credit\Responses\State;
use DragonCode\Contracts\Cashier\Http\Response;

class Driver extends BaseDriver
{
    protected $exception = Manager::class;

    protected $statuses = Statuses::class;

    protected $details = Details::class;

    public function start(): Response
    {
        $request = Init::make($this->model);

        return $this->request($request, Created::class);
    }

    public function check(): Response
    {
        $request = GetState::make($this->model);

        return $this->request($request, State::class);
    }

    public function refund(): Response
    {
        $request = Cancel::make($this->model);

        return $this->request($request, Refund::class);
    }
}
