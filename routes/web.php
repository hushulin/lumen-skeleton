<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/test' , function () use ($router) {
    return DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->where('id', '<', 3)->get();
});

$router->get('/make-order', function () use ($router) {
    return DB::transaction(function () {
        $order = Order::query()->create([
            'sn' => uniqid(),
            'open_id' => rand(100000000,900000000),
            'platform_type' => rand(0,9),
            'order_no' => uniqid(),
            'shop_no' => uniqid(),
            'recipient_name' => uniqid(),
            'recipient_phone' => uniqid(),
            'recipient_address' => uniqid(),
            'pick_type' => rand(1,2),
            'order_type' => rand(1,2),
        ]);


        $order->items()->createMany([
            ['drug_id' => rand(1000,10000), 'sku' => '000', 'drug_name' => uniqid(), 'pinyin_name' => uniqid()],
            ['drug_id' => rand(1000,10000), 'sku' => '000', 'drug_name' => uniqid(), 'pinyin_name' => uniqid()],
        ]);

        $order->items()->createMany([
            ['drug_id' => rand(1000,10000), 'sku' => '000', 'drug_name' => uniqid(), 'pinyin_name' => uniqid()],
            ['drug_id' => rand(1000,10000), 'sku' => '000', 'drug_name' => uniqid(), 'pinyin_name' => uniqid()],
        ]);
    });
});

$router->get('/update-order', function () use ($router) {
    return DB::transaction(function () {
        Order::query()->where('id', 3)->update([
            'open_id' => uniqid()
        ]);
        OrderItem::query()->where('id', 3)->update([
            'drug_name' => uniqid()
        ]);
    });
});

