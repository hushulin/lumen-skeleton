<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rqlite')->create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('online_order_id')->comment('线上单id');
            $table->string('sku', 50)->comment('商家sku');

            $table->unsignedInteger('drug_id')->default(0)->comment('商品id');
            $table->string('drug_name')->comment('商品名');
            $table->string('generic_name', 100)->default('')->comment('通用名');
            $table->string('pinyin_name')->comment('拼音码');
            $table->string('upc',50)->default('')->comment('UPC条形码');
            $table->string('variety', 20)->default('')->comment('剂型');
            $table->string('spec', 100)->default('')->comment('规格');
            $table->string('unit', 20)->default('')->comment('单位');
            $table->string('factory_name')->default('')->comment('生产企业');
            $table->string('factory_address')->default('')->comment('生产地址');
            $table->tinyInteger('otc_rx')->default(0)->comment('1. 甲类OTC2, 乙类OTC3. 处方药');

            $table->unsignedDecimal('price', 11)->default(0)->comment('商品单价');
            $table->unsignedInteger('number')->default(0)->comment('商品数量');
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
        Schema::connection('rqlite')->dropIfExists('order_items');
    }
}
