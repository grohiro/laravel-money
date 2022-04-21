# laravel-money

Laravel custom cast library for [moneyphp/money](https://github.com/moneyphp/money).

## Installation

```bash
$ composer require grohiro/laravel-money
```

## Usage

```sql
alter table products add column price decimal(11, 0);
alter table products add column price_currency varchar(3);
```

```php
class Product extends Model
{
  protected $casts = [
    'price' => MoneyCast::class,
  ];
}

$product->price = new \Money\Money(1050, new \Money\Currency('USD'));
# price => 1050, price_currency => 'USD'

$product->price = \money('10.5', 'USD'); // see src/functions.php
# price => 1050, price_currency => 'USD'

$json = MoneyHelper::json($product->price);
print_r($json);
/*
 'amount' => 1050,
 'decimal' => '10.5',
 'code' => 'USD',
 'text' => '10.5USD',
 */
```

## Tests

```bash
$ composer test
```