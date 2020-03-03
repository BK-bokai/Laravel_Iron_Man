<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transaction extends Model
{
    //資料表名稱
    protected $table = 'transaction';

    //主鍵名稱
    protected $promaryKey = 'id';

    //可以大量指定異動的欄位(Mass Assignment)
    protected $fillable = [
        'user_id',
        'merchandise_id',
        'price',
        'buy_count',
        'total_price',
    ];

    public function user()
    {
        /**
         * User::class related 关联模型
         * user_id ownerKey 当前表关联字段
         * id relation 关联表字段
         */
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function Merchandise()
    {
        /**
         * Post::class related 关联模型
         * id foreignKey 当前表关联字段
         * merchandise_id localKey 关联表字段
         */
        return $this->hasOne('App\Models\Merchandise', 'id', 'merchandise_id');
    }

}
