<?php

namespace App\Http\Controllers;

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

use App\Models\CreateCart;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    protected $config;
    // protected $vnp_TmnCode = "XB2PNONI"; //Mã định danh merchant kết nối (Terminal Id)
    // protected $vnp_HashSecret = "NCUZCXBRGKAMMFPNYEWYWEDHEGMASAHY"; //Secret key
    // protected $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    // protected $vnp_Returnurl = "{{ route('payment.pay_return') }}";
    // protected $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
    // protected $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
    // //Config input format
    // //Expire
    // protected $startTime;
    // protected $expire ;

    public function __construct()
    {
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
        $this->config = [
            'vnp_TmnCode' => 'XB2PNONI',
            'vnp_HashSecret' => 'NCUZCXBRGKAMMFPNYEWYWEDHEGMASAHY',
            'vnp_Url' => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html',
            'vnp_Returnurl' => route('payment.pay_return'),
            'vnp_apiUrl' => 'http://sandbox.vnpayment.vn/merchant_webapi/merchant.html',
            'apiUrl' => "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction",
            'startTime' => $startTime,
            'expire' => $expire
        ];
        // $this->startTime = date('Y-m-d H:i:s');
        // $this->expire = date('Y-m-d H:i:s',strtotime('+15 minutes',strtotime($this->startTime)));
    }
    public function show()
    {
        return view('client.payment.index');
    }
    public function pay(Request $request)
    {
        // dd($request->all());
        $amount = $request->totalPrice;
        
        return view('client.payment.pay', [
            'amount' => $amount
        ]);
    }
    public function create_pay(Request $request)
    {
        $this->config['amount'] = $request->amount;
        $this->config['language'] = $request->language;
        $this->config['bankCode'] = $request->bankCode;
        $vnp_TxnRef = rand(1, 10000); //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $request->amount; // Số tiền thanh toán
        $vnp_Locale = $this->config['language']; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = $this->config['bankCode']; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán
        $inputData = array(
            'vnp_Version' => '2.1.0',
            'vnp_TmnCode' => $this->config['vnp_TmnCode'],
            'vnp_Amount' => $vnp_Amount * 100,
            'vnp_Command' => 'pay',
            'vnp_CreateDate' => date('YmdHis'),
            'vnp_CurrCode' => 'VND',
            'vnp_IpAddr' => $vnp_IpAddr,
            'vnp_Locale' => $vnp_Locale,
            'vnp_OrderInfo' => "Thanh toan GD:$vnp_TxnRef",
            'vnp_OrderType' => 'other',
            'vnp_ReturnUrl' => $this->config['vnp_Returnurl'],
            'vnp_TxnRef' => $vnp_TxnRef,
            'vnp_ExpireDate' => $this->config['expire'],
        );
        // dd($inputData);
        // die();
        if (isset($vnp_BankCode) && $vnp_BankCode != '') {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = '';
        $i = 0;
        $hashdata = '';
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . '=' . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . '=' . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . '=' . urlencode($value) . '&';
        }

        $vnp_Url = $this->config['vnp_Url'] . '?' . $query;
        if (isset($this->config['vnp_HashSecret'])) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $this->config['vnp_HashSecret']); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }

    public function pay_return(Request $request)
    {
        $order = Payment::where('order_code',$request->vnp_TxnRef)->first();
        if (!$order) {
            $oldCart = session()->get('cart') ? session()->get('cart') : null;
            $newCart = new CreateCart($oldCart);
            $newCart->insertCartToDB($request->vnp_TxnRef);
            session()->forget('cart');
            $payment = new Payment();
            $payment->firstOrCreate(['order_code' => $request->vnp_TxnRef],[
                'order_code' => $request->vnp_TxnRef,
                'amount' => floor($request->vnp_Amount/100),
                'content' => $request->vnp_OrderInfo,
                'vnpay_code' => $request->vnp_ResponseCode,
                'bank_code' => $request->vnp_TransactionNo,
                'time_payment' => date('Y-m-d H:i:s'),
                'result' => $request->vnp_ResponseCode == '00' ? 1 : 0,
                'cart_id' => $request->vnp_TxnRef
            ]);
        }
        return view('client.payment.pay_return',[
            'config' => $this->config
        ]);
    }
}
