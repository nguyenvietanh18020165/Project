<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use App\Models\carts;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momoAtm(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $_POST['total_momo'];
        $orderId = time() ."";
        $redirectUrl = "http://127.0.0.1:8000/payment/momo-check";
        $ipnUrl = "http://127.0.0.1:8000/payment/momo-check";
        $extraData = "";




        $requestId = time() . "";
        $requestType = "captureWallet";
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);
//        dd($jsonResult);
        error_log(print_r($jsonResult, true));
        return redirect()->to($jsonResult['payUrl']);
    }

    public function check(Request $request)
    {
//        dd($request->all());
        if ($request->resultCode == 0) {
            Payment::create([
                'user_id' => Auth::id(),
                'status' => 1,
                'payment' => $request->orderType
            ]);
        }
        return redirect()->route('cart_detail');
    }

    public function orders(Request $request)
    {
//        dd($request->all());
//        if ($request->resultCode == 0) {
            Payment::create([
                'user_id' => Auth::id(),
                'status' => 1,
                'payment' => 'Chưa thanh toán'
            ]);
//        }
        return redirect()->route('cart_detail');
    }

    public function cancel()
    {
        Payment::where('user_id', Auth::id())->update([
            'status' => 3
        ]);
        return redirect()->route('cart_detail');
    }

    public function adminActive($id)
    {
        Payment::where('user_id', $id)->update([
            'status' => 2
        ]);
        return 1;
    }

    public function adminCancel($id)
    {
        Payment::where('user_id', $id)->delete();
        return 1;
    }

    public function adminDone($id)
    {
        Payment::where('user_id', $id)->update([
            'status' => 0
        ]);
        carts::where('user_id', $id)->delete();
        return 1;
    }
}
