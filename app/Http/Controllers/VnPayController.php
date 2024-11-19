<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Transaction;
use App\Models\Transactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\VipPackage;
use App\Models\SaleNews;
use Illuminate\Support\Carbon;

class VnPayController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function initiatePayment(Request $request)
    {

        // $vnp_transactionOwner = isset($request['id_channel']) ? $request['id_channel'] : $request['id_user'];

        // $listing = SaleNews::findOrFail($request->sale_new_id);
        if(isset($request->sale_new_id)){
            $idNewsOrChannel = $request->sale_new_id;
        } else {
            $idNewsOrChannel = "C";
        }

        $vipPackage = VipPackage::findOrFail($request->vip_package_id);
        // dd($vipPackage);

        // dd($vipPackage, $request);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://datn.lndo.site/IPN";
        $vnp_TmnCode = "KA9BQ8KD"; // Mã website tại VNPAY
        $vnp_HashSecret = "9Y2K4UHS31CG1PV5ECLNNOIY8Q3385CP"; // Chuỗi bí mật
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        // $vnp_channel_id = $request['channel_id'] ?? null;
        // $vnp_user_id = $vnp_channel_id ? null : $request['user_id'];

        $vnp_channel_id = $request['channel_id'];
        $vnp_user_id = $request['user_id'];

        $prefix = !empty($vnp_channel_id) ? 'CN_' . $vnp_channel_id : 'US_' . $vnp_user_id;
        $OrderInfo = $prefix . '_' . $vipPackage->vip_package_id . '_' . $idNewsOrChannel .  '_' .substr(str_shuffle(str_repeat($characters, 8)), 0, 8);
        $vnp_TxnRef = $OrderInfo; // Mã đơn hàng
        $vnp_OrderInfo = $OrderInfo;
        $vnp_OrderType = "topup";
        $vnp_Amount = $vipPackage->price * 100;
        $vnp_Locale = "en";
        $vnp_BankCode = ""; // Mã ngân hàng
        $vnp_IpAddr = $request->ip(); // Địa chỉ IP của người dùng

        // Thời gian hết hạn thanh toán
        //  $vnp_ExpireDate = date('YmdHis', strtotime('+30 minutes'));

        // Thông tin người thanh toán
        $vnp_Bill_Mobile = '84932224546';
        $vnp_Bill_Email = 'lphuonguye.ecn.2182004@gmail.com';
        $fullName = trim("Le Phuoc Nguyen");

        if (isset($fullName) && trim($fullName) != '') {
            $name = explode(' ', $fullName);
            $vnp_Bill_FirstName = array_shift($name);
            $vnp_Bill_LastName = array_pop($name);
        }

        // Tạo dữ liệu thanh toán
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "USD",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            //  "vnp_ExpireDate" => $vnp_ExpireDate,
            "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            "vnp_Bill_Email" => $vnp_Bill_Email,
            "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
            "vnp_Bill_LastName" => $vnp_Bill_LastName,
            "vnp_Inv_Type" => 1,
            // "vnp_Provider" => "123"
        ];

        // Nếu có mã ngân hàng thì thêm vào tham số
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );
        if (isset($returnData)) {
            header('Location: ' . $vnp_Url);
            
            die();
        } else {
            echo json_encode($returnData);
        }
    }



    public function handleIPN()
    {

        $vnp_HashSecret = "9Y2K4UHS31CG1PV5ECLNNOIY8Q3385CP";

        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        // dd($inputData);

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            // if ($_GET['vnp_ResponseCode'] == '00') {
            //     echo "GD Thanh cong";
            // } else {
            //     echo "GD Khong thanh cong";
            // }
            $vnp_Amount = $_GET['vnp_Amount'];
            $vnp_BankCode = $_GET['vnp_BankCode'];
            $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
            $vnp_CardType = $_GET['vnp_CardType'];
            $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
            $vnp_PayDate = date('Y-m-d H:i:s', strtotime($_GET['vnp_PayDate']));
            $vnp_ResponseCode = $_GET['vnp_ResponseCode'];
            $vnp_TmnCode = $_GET['vnp_TmnCode'];
            $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
            $vnp_TransactionStatus = $_GET['vnp_TransactionStatus'];
            $vnp_TxnRef = $_GET['vnp_TxnRef'];
            $vnp_SecureHash = $_GET['vnp_SecureHash'];
            $user_id = strpos($vnp_OrderInfo, 'US_') === 0 ? intval(explode('_', $vnp_OrderInfo)[1]) : null;
            $channel_id = strpos($vnp_OrderInfo, 'CN_') === 0 ? intval(explode('_', $vnp_OrderInfo)[1]) : null;
            $id_package = strpos($vnp_OrderInfo, '_') !== false ? intval(explode('_', $vnp_OrderInfo)[2]) : null;
            $idNewsOrChannel = strpos($vnp_OrderInfo, '_') !== false ? intval(explode('_', $vnp_OrderInfo)[3]) : null;

            // dd($id_package, $idNewsOrChannel );


            $upgrade = strpos($vnp_OrderInfo, 'US_') === 0 ? 'Upgrade Sale News' : 'Upgrade Channel';
            $status = ($vnp_TransactionStatus === "00") ? "Success" : "Incomplete";

            // Dữ liệu cần lưu vào bảng Transaction
            $transactionData = [
                'user_id' => $user_id,
                'channel_id' => $channel_id,
                'amount' => $vnp_Amount / 100,  
                'currency' => 'USD',
                'status' => $status,  
                'transaction_date' => $vnp_PayDate,
                'vnp_response_code' => $vnp_ResponseCode,
                'vnp_transaction_no' => $vnp_TransactionNo,
                'payment_method' => $vnp_CardType,
                'description' => $vnp_OrderInfo,
                'vnp_BankCode' => $vnp_BankCode,
                'vnp_BankTranNo' => $vnp_BankTranNo,
                'vnp_TmnCode' => $vnp_TmnCode,
                'vnp_TxnRef' => $vnp_TxnRef,
                'upgrade' => $upgrade,
                'created_at' => now(),
            ];
            $query=DB::table('transactions')->insert($transactionData);

            if ($_GET['vnp_ResponseCode'] == '00') {
                $listing = SaleNews::findOrFail($idNewsOrChannel);
                $vipPackage = VipPackage::findOrFail($id_package);
                $listing->vip_package_id = $id_package;
                $listing->vip_start_at = Carbon::now();
                $listing->vip_end_at = Carbon::now()->addDays($vipPackage->duration);
                $listing->save();

                return redirect('/salenews-status')->with('alert', [
                    'type' => 'success',
                    'message' => 'Payment Successful!'
                ]);
            } else {
                return redirect('/salenews-status')->with('alert', [
                    'type' => 'error',
                    'message' => 'Payment Failed!'
                ]);
            }
        } else {
            return redirect('/salenews-status')->with('alert', [
                'type' => 'error',
                'message' => 'Invalid Signature!'
            ]);
        }
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
