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

namespace Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

class OrderItem extends Model
{
    protected $fillable = ['name', 'quantity', 'price'];

    protected $casts = [
        'quantity' => 'int',
        'price'    => 'float',
    ];

    public function __construct()
    {
        parent::__construct([
            'name'     => TestCase::ORDER_ITEM_TITLE,
            'quantity' => 1,
            'price'    => TestCase::PAYMENT_SUM,
        ]);
    }
}
