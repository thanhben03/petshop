<?php

namespace App\Http\Controllers;

use App\Models\DetailCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminOrderController extends Controller
{
    public function api()
    {
        $list = DB::select(DB::raw('SELECT a.username,p.name,p.price,p.image,d_c.total,d_c.quantity,d_c.id FROM cart c
        JOIN detail_carts d_c ON c.id = d_c.cartId
        JOIN products p ON d_c.product_id = p.id
        JOIN accounts a ON a.id = c.user_id'));
        // dd($list);
        // dd(json_encode($list));
        return DataTables::of($list)
            // ->addColumn('category_name', function ($object) {
            //     return $object->category->name;
            // })
            // ->addColumn('inventory_quantity', function ($object) {
            //     return $object->inventory->quantity;
            // })
            // ->addColumn('discount', function ($object) {
            //     return $object->discount->discount_percent;
            // })
            // ->addColumn('edit', function ($object) {
            //     return route('product.edit', $object);
            // })
            // ->addColumn('destroy', function ($object) {
            //     return route('product.destroy', $object);
            // })
            // ->editColumn('created_at', function ($object) {
            //     return $object->year_created_at;
            // })
            ->addColumn('edit', function ($object) {
                return route('order.edit', $object->id);
            })
            ->addColumn('destroy', function ($object) {
                return route('order.destroy', $object->id);
            })
            ->make(true);
    }

    public function index()
    {
        return view('admin.order.index');
    }

    public function edit($id)
    {
        $cart = DetailCart::where('id', $id)->first();
        return view('admin.order.edit', [
            'data' => $cart
        ]);
    }

    public function update(Request $request, $id)
    {
        $cart = DetailCart::find($id);
        $cart->status = $request->status;
        $cart->total = $request->total;
        $cart->quantity = $request->quantity;
        $cart->save();
        return response([
            'status' => 'success',
            'msg' => 'Chỉnh sửa thành công !'
        ], 200);
    }

    public function destroy(Request $request,$id)
    {
        $cart = DetailCart::find($id);
        $cart->delete();

        return response([
            'status' => 'true',
            'msg' => 'Xóa thành công !'
        ]);
    }
}
