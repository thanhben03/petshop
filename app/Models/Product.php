<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','desc','image','category_id','inventory_id','discount_id','price'
    ];
    // protected $hidden = ['image'];

    public function getCurrencyAttribute()
    {
        return number_format($this->price, 0, ',', '.');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function inventory()
    {
        return $this->belongsTo(ProductInventory::class);
        
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
        
    }
}
