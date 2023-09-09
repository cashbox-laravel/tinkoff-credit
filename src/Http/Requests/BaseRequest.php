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
 * @see https://cashbox.city
 */

declare(strict_types=1);

namespace Cashbox\Tinkoff\Credit\Http\Requests;

use Cashbox\Core\Http\Request;
use Cashbox\Core\Services\Auth;
use Cashbox\Tinkoff\Auth\BasicAuth;
use DragonCode\Support\Facades\Helpers\Str;

/**
 * @see https://www.tinkoff.ru/business/help/sales/loans/how-to-integrate/API/
 */
abstract class BaseRequest extends Request
{
    protected string $productionHost = 'https://forma.tinkoff.ru';

    protected Auth|string|null $auth = BasicAuth::class;

    public function url(): ?string
    {
        return Str::replaceFormat(parent::url(), [
            'orderNumber' => $this->resource->paymentId(),
        ], '{%s}');
    }

    protected function clientId(): string
    {
        if (static::isProduction()) {
            return $this->resource->config->credentials->clientId;
        }

        return Str::start($this->resource->config->credentials->clientId, 'demo-');
    }

    protected function clientSecret(): string
    {
        return $this->resource->config->credentials->clientSecret;
    }
}
