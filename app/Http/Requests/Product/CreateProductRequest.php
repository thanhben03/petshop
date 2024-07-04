<?php

namespace App\Http\Requests\Product;

use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductInventory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'bail',
                'required',
                'max:255',
                Rule::unique(Product::class)
            ],
            'desc'=> [
                'required',
                'max:255'
            ],
            'category_id' => [
                'required',
                Rule::exists(ProductCategory::class,'id')
            ],
            'inventory_id' => [
                'required',
                Rule::exists(ProductInventory::class,'id')
            ],
            'discount_id' => [
                'required',
                Rule::exists(Discount::class,'id')
            ],
            'image' => [
                'image'
            ],
            'price' => ['min:0','gt:10000']
        ];
    }
}
