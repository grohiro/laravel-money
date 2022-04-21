<?php

use Money\Currency;
use Money\Money;
use Grohiro\LaravelMoney\MoneyHelper;

/**
 * @param int $amount
 * @param string|Currency $currency
 * @return Money 
 */
function money($amount, $currency) : Money
{
    if (is_string($currency)) {
        $cc = currency($currency);
    } else {
        $cc = $currency;
    }
    return new Money($amount, $cc);
}

function currency($code)
{
    return new Currency($code);
}

function format_money(Money $money)
{
    return MoneyHelper::decimalFormatter()->format($money);
}

function json_money(Money $money)
{
    return MoneyHelper::json($money);
}
