<?php
namespace Tests;

use Money\Money;
use Money\Currency;

class ItemTest extends TestCase
{
    public function testCast()
    {
        $price = new Money(1500, new Currency('USD')); // 10.5 USD
        $item = new Item();
        $item->price = $price;

        $attributes = $item->getAttributes();
        $this->assertEquals(1500, $attributes['price']);
        $this->assertEquals('USD', $attributes['price_currency']);
    }
}
