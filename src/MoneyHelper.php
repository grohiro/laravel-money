<?php
namespace Grohiro\LaravelMoney;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;
use Money\MoneyFormatter;
use Money\MoneyParser;
use Money\Parser\DecimalMoneyParser;

class MoneyHelper
{
    static $formatter;

    static $parser;

    public static function decimalFormatter() : MoneyFormatter
    {
        if (static::$formatter === null) {
            $currencies = new ISOCurrencies();
            static::$formatter = new DecimalMoneyFormatter($currencies);
        }
        return static::$formatter;
    }

    public static function decimalParser() : MoneyParser
    {
        if (static::$parser === null) {
            $currencies = new ISOCurrencies();
            static::$parser = new DecimalMoneyParser($currencies);
        }
        return static::$parser;
    }

    public static function json(Money $money)
    {
        $currencies = new ISOCurrencies();
        $decimal = static::decimal($money);
        $code = $money->getCurrency()->getCode();
        return [
            'amount' => $money->getAmount(),
            'code' => $code,
            'decimal' => $decimal,
            'subunit' => $currencies->subunitFor($money->getCurrency()),
            'text' => $decimal.$code,
        ];
    }

    public static function decimal(Money $money)
    {
        return static::decimalFormatter()->format($money);
    }

    public static function parse($decimal, \Money\Currency $currency)
    {
        return static::decimalParser()->parse($decimal, $currency);
    }
}
