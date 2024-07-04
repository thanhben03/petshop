<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = [
        'user_id','order_code'
    ];
    protected $appends = [
        'test'
    ];
    use HasFactory;
    
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
        
    }

    public function detailProducts()
    {
        return $this->hasMany(DetailCart::class,'cartId','id');
    }

    public function getTestAttribute()
    {
        return '123';
    }
}
