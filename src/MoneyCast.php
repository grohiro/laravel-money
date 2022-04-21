<?php

namespace Grohiro\LaravelMoney;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Money\Money;
use Money\Currency;

class MoneyCast implements CastsAttributes
{
    public static $SUFFIX = '_currency';

    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, $key, $value, $attributes)
    {
        $codeField = $key.static::$SUFFIX;
        $code = $model->$codeField;
        return new Money($model->$key, new Currency($code));
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        if (!$value instanceof Money) {
            throw new \Exception('$value must be an instance of Money');
        }

        $codeField = $key.static::$SUFFIX;

        return [
            $key => $value->getAmount(),
            $codeField => $value->getCurrency()->getCode(),
        ];
    }
}
