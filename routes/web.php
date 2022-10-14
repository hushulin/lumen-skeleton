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

$router->get('/phpinfo-99i2284kk', function () use ($router) {
   return phpinfo();
});

$router->get('/test' , function () use ($router) {
    return Order::query()->where('id', '>', rand(1000,10000))->take(10)->get();
});

$router->get('/start-transaction', function () use ($router) {
    return DB::connection();
});

$router->get('/make-order', function () use ($router) {
    return DB::connection('rqlite')->transaction(function () {
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
    return DB::connection('rqlite')->transaction(function () {
        Order::query()->where('id', rand(1000,10000))->update([
            'open_id' => uniqid()
        ]);
        OrderItem::query()->where('id', rand(1000,100000))->update([
            'drug_name' => uniqid()
        ]);
    });
});


$router->get('/raw-update', function () {
    return DB::connection('rqlite')->getPdo()->transactionRaw([
        ['update orders set open_id = ? where id = ?', date('YmdHis'), 1],
        ['update orders set open_id = ? where id = ?', date('YmdHis'), 2],
    ]);
});

$router->get('/raw-update-2', function () {
    return DB::connection('rqlite')->getPdo()->transactionRaw([
        ['update orders set open_id = ? where id = ?', date('YmdHis'), 1],
        ['update orders set open_id = ? where ids = ?', date('YmdHis'), 2],
    ]);
});
