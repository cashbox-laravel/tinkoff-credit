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

namespace Tests\Jobs;

use Cashbox\Core\Constants\Status;
use Cashbox\Core\Facades\Config\Payment as PaymentConfig;
use Cashbox\Core\Services\Jobs;
use Cashbox\Tinkoff\Credit\Exceptions\Http\CancelDeniedException;
use DragonCode\Support\Facades\Http\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\Fixtures\Models\RequestPayment;
use Tests\TestCase;

class JobsTest extends TestCase
{
    use RefreshDatabase;

    protected $model = RequestPayment::class;

    public function testStart()
    {
        $this->assertSame(0, DB::table('payments')->count());
        $this->assertSame(0, DB::table('cashier_details')->count());

        $payment = $this->payment();

        Jobs::make($payment)->start();

        $payment->refresh();

        $this->assertSame(1, DB::table('payments')->count());
        $this->assertSame(1, DB::table('cashier_details')->count());

        $this->assertIsString($payment->cashbox->external_id);
        $this->assertMatchesRegularExpression('/^demo-\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b$/', $payment->cashbox->external_id);

        $this->assertTrue(Url::is($payment->cashbox->details->getUrl()));

        $this->assertSame('NEW', $payment->cashbox->details->getStatus());

        $this->assertSame(
            PaymentConfig::getStatuses()->getStatus(Status::NEW),
            $payment->status_id
        );
    }

    public function testCheck()
    {
        $this->assertSame(0, DB::table('payments')->count());
        $this->assertSame(0, DB::table('cashier_details')->count());

        $payment = $this->payment();

        Jobs::make($payment)->start();
        Jobs::make($payment)->check(true);

        $payment->refresh();

        $this->assertSame(1, DB::table('payments')->count());
        $this->assertSame(1, DB::table('cashier_details')->count());

        $this->assertIsString($payment->cashbox->external_id);
        $this->assertMatchesRegularExpression('/^demo-\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b$/', $payment->cashbox->external_id);

        $this->assertTrue(Url::is($payment->cashbox->details->getUrl()));

        $this->assertSame('NEW', $payment->cashbox->details->getStatus());

        $this->assertSame(
            PaymentConfig::getStatuses()->getStatus(Status::NEW),
            $payment->status_id
        );
    }

    public function testRefund()
    {
        $this->expectException(CancelDeniedException::class);
        $this->expectExceptionMessage('Запрещено отменять эту заявку');

        $this->assertSame(0, DB::table('payments')->count());
        $this->assertSame(0, DB::table('cashier_details')->count());

        $payment = $this->payment();

        $this->assertSame(
            PaymentConfig::getStatuses()->getStatus(Status::NEW),
            $payment->status_id
        );

        Jobs::make($payment)->start();
        Jobs::make($payment)->refund();
    }
}
