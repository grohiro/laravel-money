<?php
namespace Tests;

use Money\Money;
use Grohiro\LaravelMoney\MoneyHelper;

class MoneyHelperTest extends TestCase
{
    public function testDecimalUSD()
    {
        $money = \money(1050, 'USD');
        $this->assertTrue($money instanceof Money);

        $this->assertEquals('10.50', MoneyHelper::decimal($money));
    }

    public function testDecimalJPY()
    {
        $money = \money(1050, 'JPY');
        $this->assertTrue($money instanceof Money);

        $this->assertEquals(1050, MoneyHelper::decimal($money));
    }

    public function testJsonUSD()
    {
        $money = \money(1050, 'USD');
        $json = MoneyHelper::json($money);

        $this->assertEquals($json['amount'], 1050);
        $this->assertEquals($json['decimal'], '10.50');
        $this->assertEquals($json['code'], 'USD');
        $this->assertEquals($json['text'], '10.50USD');
        $this->assertEquals($json['subunit'], 2);
    }

    public function testJsonJPY()
    {
        $money = \money(1050, 'JPY');
        $json = MoneyHelper::json($money);

        $this->assertEquals($json['amount'], 1050);
        $this->assertEquals($json['decimal'], '1050');
        $this->assertEquals($json['code'], 'JPY');
        $this->assertEquals($json['text'], '1050JPY');
        $this->assertEquals($json['subunit'], 0);
    }
}
