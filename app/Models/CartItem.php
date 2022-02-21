<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    //禁止修改的欄位
    protected $guarded = [''];
    //可以修改的欄位protected $fillable = [''];
    //get資料時，要被隱藏的欄位protected $hidden = [''];
    //自製的屬性
    protected $appends = ['current_price'];
    public function getCurrentPriceAttribute()
    {
        //自製屬性的邏輯
        return $this->quantity * 10;
    }

    //一對多的table關係
    public function product()
    {
        //CartItem中的product_id是屬於Product table的
        return $this->belongsTo(Product::class);
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
