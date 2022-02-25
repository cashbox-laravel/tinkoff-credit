# Tinkoff Credit

![cashier provider driver template](https://preview.dragon-code.pro/cashier-provider/tinkoff-credit.svg?brand=laravel)

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]


## Installation

To get the latest version of `Tinkoff Credit`, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require cashier-provider/tinkoff-credit
```

Or manually update `require` block of `composer.json` and run `composer update`.

```json
{
    "require": {
        "cashier-provider/tinkoff-credit": "^1.0"
    }
}
```

## Using

> **Note**:
>
> This project is the driver for [`Cashier Provider`](https://github.com/cashier-provider/core).
>
> Shop ID and Show Case ID must be provided by the bank manager in response to the agreement concluded with the bank.


### Configuration

Add your driver information to the `config/cashier.php` file:

```php
use App\Models\Payment;
use App\Payments\Tinkoff as TinkoffDetails;
use CashierProvider\Core\Constants\Driver;
use CashierProvider\Tinkoff\Credit\Driver as TinkoffCreditDriver;

return [
    'payment' => [
        'map' => [
            Payment::TYPE_TINKOFF_CREDIT => 'tinkoff_credit'
        ]
    ],

    'drivers' => [
        'tinkoff_credit' => [
            Driver::DRIVER  => TinkoffCreditDriver::class,
            Driver::DETAILS => TinkoffDetails::class,

            'shop_id'      => env('CASHIER_TINKOFF_CREDIT_SHOP_ID'),
            'show_case_id' => env('CASHIER_TINKOFF_CREDIT_SHOW_CASE_ID'),
            'promocode'    => env('CASHIER_TINKOFF_CREDIT_PROMOCODE', 'default'),
        ]
    ]
];
```

### Resource

Create a model resource class inheriting from `CashierProvider\Core\Resources\Model` in your application.

Use the `$this->model` link to refer to the payment model. When executed, the `$model` parameter will contain the payment instance.

```php
namespace App\Payments;

use CashierProvider\Core\Resources\Model;

class BankName extends Model
{
    protected function paymentId(): string
    {
        return (string) $this->model->id;
    }

    protected function sum(): float
    {
        return (float) $this->model->sum;
    }

    protected function currency(): int
    {
        return $this->model->currency;
    }

    protected function createdAt(): Carbon
    {
        return $this->model->created_at;
    }
}
```

#### Custom Authentication

In some cases, the application can send requests to the bank from different terminals. For example, when one application serves payments of several companies.

In order for the payment to be authorized with the required authorization data, you can override the `clientId` and `clientSecret` methods:

```php
namespace App\Payments;

use App\Models\Payment;
use CashierProvider\Core\Resources\Model;
use Illuminate\Database\Eloquent\Builder;

class BankName extends Model
{
    protected $bank;

    protected function clientId(): string
    {
        return $this->bank()->client_id;
    }

    protected function clientSecret(): string
    {
        return $this->bank()->client_secret;
    }

    protected function paymentId(): string
    {
        return (string) $this->model->id;
    }

    protected function sum(): float
    {
        return (float) $this->model->sum;
    }

    protected function currency(): int
    {
        return $this->model->currency;
    }

    protected function createdAt(): Carbon
    {
        return $this->model->created_at;
    }

    protected function bank()
    {
        if (! empty($this->bank)) {
            return $this->bank;
        }

        return $this->bank = $this->model->types()
            ->where('type', Payment::TYPE_BANK_NAME)
            ->firstOrFail()
            ->bank;
    }
}
```

### Response

All requests to the bank and processing of responses are carried out by the [`Cashier Provider`](https://github.com/cashier-provider/core) project.

To get a link, contact him through the cast:

```php
use App\Models\Payment;

public function getCredit(Payment $payment): string
{
    return $payment->cashier->details->getUrl();
}
```

### Available Methods And Details Data

```php
$payment->cashier->external_id
// Returns the bank's transaction ID for this operation

$payment->cashier->details->getStatus(): ?string
// Returns the text status from the bank
// For example, `NEW`.

$payment->cashier->details->getUrl(): ?string
// If the request to get the link was successful, it will return the URL
// For example, `https://dev.bank-uri.com/<hash>?<params>`

$payment->cashier->details->toArray(): array
// Returns an array of status and URL.
// For example,
//
// [
//     'url' => 'https://dev.bank-uri.com/<hash>?<params>',
//     'status' => 'NEW'
// ]
```

[badge_downloads]:      https://img.shields.io/packagist/dt/cashier-provider/core.svg?style=flat-square

[badge_license]:        https://img.shields.io/packagist/l/cashier-provider/core.svg?style=flat-square

[badge_stable]:         https://img.shields.io/github/v/release/cashier-provider/core?label=stable&style=flat-square

[badge_unstable]:       https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]:         LICENSE

[link_packagist]:       https://packagist.org/packages/cashier-provider/core
