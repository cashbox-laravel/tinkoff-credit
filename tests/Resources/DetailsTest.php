<?php

namespace Tests\Resources;

use CashierProvider\Core\Resources\Details as BaseDetails;
use CashierProvider\Tinkoff\Credit\Resources\Details;
use DragonCode\Contracts\Cashier\Resources\Details as DetailsContract;
use Tests\TestCase;

class DetailsTest extends TestCase
{
    protected $expected = [
        'status' => self::STATUS,
        'url'    => self::URL,
        'token'  => self::TOKEN,
    ];

    public function testMake()
    {
        $details = $this->details();

        $this->assertInstanceOf(Details::class, $details);
        $this->assertInstanceOf(BaseDetails::class, $details);
        $this->assertInstanceOf(DetailsContract::class, $details);
    }

    public function testGetUrl()
    {
        $details = $this->details();

        $this->assertSame(self::URL, $details->getUrl());
    }

    public function testGetToken()
    {
        $details = $this->details();

        $this->assertSame(self::TOKEN, $details->getToken());
    }

    public function testGetStatus()
    {
        $details = $this->details();

        $this->assertSame(self::STATUS, $details->getStatus());
    }

    public function testToArray()
    {
        $details = $this->details();

        $this->assertSame($this->expected, $details->toArray());
    }

    public function testToJson()
    {
        $details = $this->details();

        $this->assertJson($details->toJson());

        $this->assertSame(json_encode($this->expected), $details->toJson());
    }

    protected function details(): Details
    {
        return Details::make($this->expected);
    }
}
