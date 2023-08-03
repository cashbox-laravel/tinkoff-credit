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

use Cashbox\Core\Enums\HttpMethodEnum;

class GetStateRequest extends BaseRequest
{
    public HttpMethodEnum $method = HttpMethodEnum::get;

    protected string $productionUri = '/api/partners/v2/orders/{orderNumber}/info';

    public function body(): array
    {
        return [];
    }
}