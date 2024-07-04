<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillingAddressRequest;
use App\Models\Account;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{

    public function addAddress(BillingAddressRequest $request)
    {
        $data = $request->validated();
        $data['uid'] = session()->get('id');
        DB::table('address_payment')->updateOrInsert(
            [
                'uid' => session()->get('id')
            ],
            $data
        );
        $this->updateConfirmAddressForAccount();

        return response([
            'msg' => 'Cập nhật thông tin thanh toán thành công',
            'status' => 'success'
        ]);
    }
    public function changePassword(Request $request)
    {
        $user = Account::where([
            ['id', '=', session()->get('id')],
            ['password', '=', $request->current_psw]
        ])->first();
        if ($request->new_psw != $request->re_newpsw) {
            return redirect()->route('password')->with('error2', 'Mật khẩu không khớp !');
        }
        if (isset($user)) {
            $user->update([
                'password' => $request->new_psw
            ]);
            
            return redirect()->route('password')->with('msg', 'Thay đổi thành công !');
        } else {
            return redirect()->route('password')->with('error', 'Mật khẩu cũ không chính xác');
        }
    }

    public function password()
    {
        return view('client.profile.password');
    }

    public function address()
    {
        $address_payment = DB::table('address_payment')->where('uid',session()->get('id'))->first();
        return view('client.profile.confirm_address', [
            'address_payment' => $address_payment
        ]);
    }
    public function updateConfirmAddressForAccount()
    {
        $account = Account::where('id', session()->get('id'))->first();
        // dd()
        $account->confirm_address = 1;
        $account->save();
        session()->put('confirm_address', 1);
    }

    public function wishlist()
    {
        $list = WishList::where('uid',session()->get('id'))
                        ->with('product')
                        ->get();
        return view('client.profile.wishlist', [
            'list' => $list
        ]);
    }

    public function checkExistAddress()
    {
        $check = Account::find(session()->get('id'));
        $result = $check->confirm_address ? true : false;

        return response([
            'status' => $result
        ]);
        
    }
}
