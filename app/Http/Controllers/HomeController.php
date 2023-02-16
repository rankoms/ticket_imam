<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Barcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function barcode_checkin(Request $request)
    {

        $voucher = $request->voucher;
        // status 1001 blm checki ln , 1019 udah checkin . 1020 checkout
        $barcode = Barcode::where('barcode', $voucher)->first();

        if (!$barcode) {
            return ResponseFormatter::error(null, 'Barcode tidak ada');
        } else {
            if ($barcode->barcode_scan_status == 1001) {
                $barcode->barcode_scan_status = 1019;
                $barcode->user_id_checkin = Auth::user()->name;
                $barcode->barcode_scan_date = date('Y-m-d H:i:s');
                $barcode->save();
                return ResponseFormatter::success($barcode, 'Success');
            } else {
                return ResponseFormatter::success($barcode, 'Already');
            }
        }
    }
    public function barcode_checkout(Request $request)
    {

        $voucher = $request->voucher;
        // status 1001 blm checki ln , 1019 udah checkin . 1020 checkout
        $barcode = Barcode::where('barcode', $voucher)->first();

        if (!$barcode) {
            return ResponseFormatter::error(null, 'Barcode tidak ada');
        } else {
            $barcode->barcode_scan_status = 1020;
            $barcode->user_id_checkout = Auth::user()->name;
            $barcode->barcode_scan_checkout = date('Y-m-d H:i:s');
            $barcode->save();
            return ResponseFormatter::success($barcode, 'Success');
        }
    }
}
