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

namespace CashierProvider\Tinkoff\Credit;

use CashierProvider\Core\Services\Driver as BaseDriver;
use CashierProvider\Tinkoff\Credit\Exceptions\Manager;
use CashierProvider\Tinkoff\Credit\Helpers\Statuses;
use CashierProvider\Tinkoff\Credit\Requests\Cancel;
use CashierProvider\Tinkoff\Credit\Requests\GetState;
use CashierProvider\Tinkoff\Credit\Requests\Init;
use CashierProvider\Tinkoff\Credit\Resources\Details;
use CashierProvider\Tinkoff\Credit\Responses\Created;
use CashierProvider\Tinkoff\Credit\Responses\Refund;
use CashierProvider\Tinkoff\Credit\Responses\State;
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
