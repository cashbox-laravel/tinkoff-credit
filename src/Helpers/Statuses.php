<?php

namespace CashierProvider\Tinkoff\Credit\Helpers;

use CashierProvider\Core\Services\Statuses as BaseStatus;

class Statuses extends BaseStatus
{
    public const NEW = [
        'new',
    ];

    public const REFUNDING = [];

    public const REFUNDED = [
        'canceled',
    ];

    public const FAILED = [
        'rejected',
    ];

    public const SUCCESS = [
        'approved',
    ];
}
