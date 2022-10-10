<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $sn 订单sn
 * @property int $company_id
 * @property int $open_id LYKY的订单id
 * @property int $platform_type 平台类型: 1美团 2饿了么 3京东到家 4京东健康
 * @property string $order_no 平台订单编号
 * @property string $shop_no 门店编号
 * @property string $recipient_name 收货人姓名
 * @property string $recipient_phone 收货人手机
 * @property string $recipient_address 收货人地址
 * @property int $pick_type 取货类型：0普通订单 1上门自提
 * @property int $order_type 订单类型：0普通订单 1处方单
 * @property int $status 订单状态，1. 已完成0. 已取消2. 已接单,线上订单过来都是已接单
 * @property int $refund_limit 订单的可退数量上限
 * @property int $refund_status 退款状态 0:没有退款, 1:全部退款, 2:部分退款
 * @property int $handle_status 默认：未出库
 * @property int $handle_uid 出库人id
 * @property int $creator_id 制单人id
 * @property string $handle_at 出库时间
 * @property integer $member_card_id 冗余线下会员卡id
 * @property string $member_card_no 冗余线下会员卡号
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static create(array $array)
 */
class Order extends RqliteModel
{

    protected $connection = 'rqlite';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'sn', 'company_id', 'open_id', 'platform_type', 'order_no', 'shop_no', 'shop_day_seq', 'store_name', 'remark', 'recipient_name', 'recipient_phone', 'recipient_address', 'pick_type', 'order_type', 'status', 'refund_limit', 'refund_status', 'handle_status', 'handle_uid', 'creator_id', 'handle_at', 'member_card_id', 'member_card_no', 'created_at', 'updated_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'company_id' => 'integer', 'open_id' => 'integer', 'shop_day_seq' => 'integer', 'platform_type' => 'integer', 'pick_type' => 'integer', 'order_type' => 'integer', 'status' => 'integer', 'refund_limit' => 'integer', 'refund_status' => 'integer', 'handle_status' => 'integer', 'handle_uid' => 'integer', 'creator_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];


    // 退款状态
    const REFUND_STATUS_NONE = 0;       // 无退款
    const REFUND_STATUS_COMPLETE = 1;   // 全部退款
    const REFUND_STATUS_PORTION = 2;    // 部分退款

    // 商品
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'online_order_id');
    }

}
