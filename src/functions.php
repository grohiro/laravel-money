<?php

use Money\Currency;
use Money\Money;
use Grohiro\LaravelMoney\MoneyHelper;

if (!function_exists('money')) {
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
}

if (!function_exists('currency')) {
    function currency($code)
    {
        return new Currency($code);
    }
}

if (!function_exists('format_money')) {
    function format_money(Money $money)
    {
        return MoneyHelper::decimalFormatter()->format($money);
    }
}

if (!function_exists('json_money')) {
    function json_money(Money $money)
    {
        return MoneyHelper::json($money);
    }
}
