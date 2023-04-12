<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Barcode;
use App\Models\Event;
use App\Models\RedeemHistory;
use App\Models\RedeemVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RedeemVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkin()
    {
        return view('checkin');
    }
    public function checkin_v2()
    {
        return view('checkin_v2');
    }
    public function checkout()
    {
        return view('checkout');
    }


    public function cek_redeem_voucher(Request $request)
    {
        $voucher = $request->voucher;

        $redeem_voucher = Barcode::where('barcode', $voucher)->first();

        if (!$redeem_voucher) {
            return ResponseFormatter::error(null, '');
        } else {
            if ($redeem_voucher->status == 1) {
                return ResponseFormatter::success($redeem_voucher, 'Data Sudah Digunakan');
            } else {
                return ResponseFormatter::success($redeem_voucher, 'Data Berhasil ada');
            }
        }
    }

    public function redeem_voucher_update(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric']
        ]);

        $barcode = Barcode::find($request->id);
        $barcode->barcode_scan_status = 1019;
        $barcode->user_id_checkin = Auth::user()->name;
        $barcode->barcode_scan_date = date('Y-m-d H:i:s');
        $barcode->save();

        return ResponseFormatter::success(null, 'Redeem E-Ticket Berhasil');
    }


    public function redeem_voucher_update_v2(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric']
        ]);

        $img = $request->image;
        $folderPath = "uploads/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        Storage::disk('public')->put($file, $image_base64);

        $redeem_voucher = RedeemVoucher::find($request->id);
        $redeem_voucher->foto_ktp = $fileName;
        $redeem_voucher->redeem_by = Auth::user()->id;
        $redeem_voucher->redeem_date = date('Y-m-d H:i:s');
        $redeem_voucher->status = 1;
        $redeem_voucher->save();

        return ResponseFormatter::success(null, 'Redeem E-Ticket Berhasil');
    }

    public function detail($kode)
    {
        $redeem_voucher = RedeemVoucher::where('kode', $kode)->first();
        if (!$redeem_voucher) {
            return redirect()->route('redeem_voucher.index');
        }

        return view('redeem_detail', compact('redeem_voucher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RedeemVoucher  $redeemVoucher
     * @return \Illuminate\Http\Response
     */
    public function show(RedeemVoucher $redeemVoucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RedeemVoucher  $redeemVoucher
     * @return \Illuminate\Http\Response
     */
    public function edit(RedeemVoucher $redeemVoucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RedeemVoucher  $redeemVoucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RedeemVoucher $redeemVoucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RedeemVoucher  $redeemVoucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(RedeemVoucher $redeemVoucher)
    {
        //
    }
}
