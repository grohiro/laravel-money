<?php
namespace Tests;

use Illuminate\Database\Eloquent\Model;
use Grohiro\LaravelMoney\MoneyCast;

class Item extends Model
{
    protected $casts = [
        'price' => MoneyCast::class,
    ];
}
