<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $online_order_id 线上单id
 * @property string $sku 商家sku
 * @property int $drug_id 商品id
 * @property string $drug_name 商品名
 * @property string $generic_name 通用名
 * @property string $pinyin_name 拼音码
 * @property string $upc UPC条形码
 * @property string $variety 剂型
 * @property string $spec 规格
 * @property string $unit 单位
 * @property string $factory_name 生产企业
 * @property integer $promotion_id 冗余线下活动id
 * @property string $promotion_type 冗余线下活动类型
 * @property string $promotion_name 冗余线下活动名称
 * @property string $factory_address 生产地址
 * @property int $otc_rx 1. 甲类OTC2, 乙类OTC3. 处方药
 * @property string $price 商品单价
 * @property string $cost_amount 成本价
 * @property int $number 商品数量
 * @property int $buy_number 购买数量
 * @property float $discount 条目折扣
 * @property float $subtotal 小计
 * @property int $refund_limit 可退数量上限
 * @property boolean $is_gift 是否是赠品
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class OrderItem extends Model
{

    protected $connection = 'rqlite';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['online_order_id', 'sku', 'drug_id', 'drug_name', 'generic_name', 'pinyin_name', 'upc', 'variety', 'spec', 'unit', 'factory_name', 'promotion_id', 'promotion_type', 'promotion_name', 'factory_address', 'otc_rx', 'price', 'cost_amount', 'number', 'buy_number', 'refund_limit', 'discount', 'subtotal', 'is_gift','drug_item'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'online_order_id' => 'integer', 'drug_id' => 'integer', 'otc_rx' => 'integer', 'number' => 'integer', 'buy_number' => 'integer', 'refund_limit' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'online_order_id', 'id');
    }

}
