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

namespace Tests\Requests;

use Cashbox\Core\Http\Request;
use Cashbox\Tinkoff\Credit\Requests\Cancel;
use DragonCode\Contracts\Cashier\Http\Request as RequestContract;
use DragonCode\Contracts\Http\Builder;
use Lmc\HttpConstants\Header;
use Tests\TestCase;

class CancelTest extends TestCase
{
    public function testInstance()
    {
        $request = $this->request(Cancel::class);

        $this->assertInstanceOf(Cancel::class, $request);
        $this->assertInstanceOf(Request::class, $request);
        $this->assertInstanceOf(RequestContract::class, $request);
    }

    public function testUri()
    {
        $request = $this->request(Cancel::class);

        $this->assertInstanceOf(Builder::class, $request->uri());

        $id = self::PAYMENT_ID;

        $this->assertSame("https://forma.tinkoff.ru/api/partners/v2/orders/{$id}/cancel", $request->uri()->toUrl());
    }

    public function testHeaders()
    {
        $request = $this->request(Cancel::class);

        $this->assertIsArray($request->headers());

        $this->assertSame([
            Header::ACCEPT       => 'application/json',
            Header::CONTENT_TYPE => 'application/json',
        ], $request->headers());
    }

    public function testGetRawHeaders()
    {
        $request = $this->request(Cancel::class);

        $this->assertIsArray($request->getRawHeaders());

        $this->assertSame([
            Header::ACCEPT       => 'application/json',
            Header::CONTENT_TYPE => 'application/json',
        ], $request->getRawHeaders());
    }

    public function testBody()
    {
        $request = $this->request(Cancel::class);

        $this->assertIsArray($request->body());
        $this->assertEmpty($request->body());
    }

    public function testGetRawBody()
    {
        $request = $this->request(Cancel::class);

        $this->assertIsArray($request->getRawBody());
        $this->assertEmpty($request->getRawBody());
    }
}
