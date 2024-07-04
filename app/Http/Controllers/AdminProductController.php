<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductInventory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdminProductController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new Product())->query();
    }
    public function index()
    {

        $products = Product::get();
        return view('admin.product.index', [
            'products' => $products
        ]);
    }

    public function api()
    {
        return DataTables::of($this->model)
            ->addColumn('category_name', function ($object) {
                return $object->category->name;
            })
            ->addColumn('inventory_quantity', function ($object) {
                return $object->inventory->quantity;
            })
            ->addColumn('discount', function ($object) {
                return $object->discount->discount_percent;
            })
            ->addColumn('edit', function ($object) {
                return route('product.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('product.destroy', $object);
            })
            // ->editColumn('created_at', function ($object) {
            //     return $object->year_created_at;
            // })
            // ->addColumn('edit', function ($object) {
            //     return route('courses.edit', $object);
            // })
            // ->addColumn('destroy', function ($object) {
            //     return route('courses.destroy', $object);
            // })
            ->make(true);
        // dd($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $discount = Discount::get();
        $product_category = ProductCategory::get();
        $product_inventory = ProductInventory::get();
        return view('admin.product.create', [
            'discount' => $discount,
            'category' => $product_category,
            'inventory' => $product_inventory
        ]);
    }

    public function store(CreateProductRequest $request)
    {
        
        $path          = Storage::disk('public')->put('avatarProduct', $request->file('image'));
        $arr           = $request->validated();
        $arr['image'] = $path;
        $query = Product::create($arr);
        if ($query) {
            return response([
                'status' => 'success',
                'msg' => 'Thêm sản phẩm thành công !'
            ], 200);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Product::where('id', $id)->with('category', 'inventory', 'discount')->first();
        $discount = Discount::get();
        $product_category = ProductCategory::get();
        $product_inventory = ProductInventory::get();
        // dd($data->category->name);
        return view('admin.product.edit', [
            'data' => $data,
            'discount' => $discount,
            'category' => $product_category,
            'inventory' => $product_inventory
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $path          = Storage::disk('public')->put('avatarProduct', $request->file('image'));
        $arr = $request->all();
        $arr['image'] = $path;
        $product->fill($arr);
        $product->save();
        return response([
            'status' => 'success',
            'msg' => 'Chỉnh sửa thành công !'
        ], 200);
    }

    public function destroy($id)
    {
        $query = Product::where('id', $id)->delete();
        if ($query) {
            return response([
                'status' => 'success',
                'msg' => 'Xóa thành công !'
            ], 200);
        }
    }
}
