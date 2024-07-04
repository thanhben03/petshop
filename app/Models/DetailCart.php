<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCart extends Model
{
    use HasFactory;
    protected $table = 'detail_carts';
    protected $fillable = [
        'product_id','quantity','total','cartId','status'
    ];
    protected $appends = [
        'product_info'
    ];

    public function getProduct()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function getProductInfoAttribute()
    {
        return $this->getProduct;
    }

    public function getStatusValueAttribute()
    {
        return $this->status ? 'Đã duyệt' : 'Chờ duyệt';
    }
}
