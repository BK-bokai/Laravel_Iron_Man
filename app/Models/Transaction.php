<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
