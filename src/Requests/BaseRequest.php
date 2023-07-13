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

declare(strict_types=1);

namespace Cashbox\Tinkoff\Credit\Requests;

use Cashbox\Core\Facades\Config\Main;
use Cashbox\Core\Http\Request;
use DragonCode\Support\Facades\Helpers\Str;
use Lmc\HttpConstants\Header;

abstract class BaseRequest extends Request
{
    protected $production_host = 'https://forma.tinkoff.ru';

    protected $headers = [
        Header::ACCEPT       => 'application/json',
        Header::CONTENT_TYPE => 'application/json',
    ];

    public function getRawHeaders(): array
    {
        return $this->headers;
    }

    public function getHttpOptions(): array
    {
        if ($this->hash) {
            return ['auth' => [$this->getShowCaseId(), $this->model->getClientSecret()]];
        }

        return [];
    }

    protected function getShowCaseId(): string
    {
        return Main::isProduction() ? $this->model->getShowCaseId() : Str::start($this->model->getShowCaseId(), 'demo-');
    }

    protected function getPath(): ?string
    {
        return str_replace('{orderNumber}', $this->model->getPaymentId(), $this->getUri());
    }

    protected function getUri(): string
    {
        if (Main::isProduction()) {
            return $this->path;
        }

        return $this->path_dev ?? $this->path;
    }
}
