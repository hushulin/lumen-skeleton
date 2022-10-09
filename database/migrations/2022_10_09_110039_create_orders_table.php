<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rqlite')->create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('sn', 50)->comment('订单sn');
            $table->unsignedInteger('company_id')->default(0);
            $table->bigInteger('open_id')->comment('LYKY的订单id');
            $table->unsignedTinyInteger('platform_type')->comment('平台类型: 1美团 2饿了么 3京东到家 4京东健康');
            $table->string('order_no', 100)->comment('平台订单编号');
            $table->string('shop_no', 100)->comment('门店编号');
            $table->string('recipient_name', 20)->comment('收货人姓名');
            $table->string('recipient_phone', 20)->comment('收货人手机');
            $table->string('recipient_address', 150)->comment('收货人地址');
            $table->unsignedTinyInteger('pick_type')->comment('取货类型：0普通订单 1上门自提');
            $table->unsignedTinyInteger('order_type')->comment('订单类型：0普通订单 1处方单');
            // status=9,缺货异常，显示作废按钮，status=3已作废，可复制
            $table->unsignedTinyInteger('status')->default(2)->comment('订单状态，1. 已完成0. 已取消2. 已接单,线上订单过来都是已接单');
            $table->unsignedTinyInteger('handle_status')->default(0)->comment('默认：未出库');
            $table->unsignedInteger('handle_uid')->default(0)->comment('出库人id');
            $table->timestamp('handle_at')->nullable()->comment('出库时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('rqlite')->dropIfExists('orders');
    }
}
