<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
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
    public function checkout()
    {
        return view('checkout');
    }

    public function summary_redeem()
    {
        $redeem_voucher = RedeemVoucher::orderBy('kategory', 'asc')->get();
        $jumlah_belum = 0;
        $jumlah_sudah = 0;
        foreach ($redeem_voucher as $key => $value) :
            if ($value->status == 0) :
                $jumlah_belum++;
                isset($kategory_aset[$value->kategory]['belum']) ? $kategory_aset[$value->kategory]['belum']++ : $kategory_aset[$value->kategory]['belum'] = 1;
            else :
                $jumlah_sudah++;
                isset($kategory_aset[$value->kategory]['sudah']) ? $kategory_aset[$value->kategory]['sudah']++ : $kategory_aset[$value->kategory]['sudah'] = 1;
            endif;
        endforeach;
        return view('summary_redeem', compact('kategory_aset', 'jumlah_belum', 'jumlah_sudah', 'redeem_voucher'));
    }

    public function dashboard(Request $request)
    {
        $redeem_voucher = RedeemVoucher::orderBy('kategory', 'asc')->get();

        $jumlah_belum = 0;
        $jumlah_sudah = 0;
        $kategory_aset = [];
        // $kategory_aset['sudah'] = [];
        // $kategory_aset['belum'] = [];
        foreach ($redeem_voucher as $key => $value) :
            if ($value->status == 0) :
                $jumlah_belum++;
                isset($kategory_aset[$value->kategory]['belum']) ? $kategory_aset[$value->kategory]['belum']++ : $kategory_aset[$value->kategory]['belum'] = 1;
            else :
                $jumlah_sudah++;
                isset($kategory_aset[$value->kategory]['sudah']) ? $kategory_aset[$value->kategory]['sudah']++ : $kategory_aset[$value->kategory]['sudah'] = 1;
            endif;
        endforeach;
        return view('admin.dashboard', compact('kategory_aset', 'jumlah_belum', 'jumlah_sudah', 'redeem_voucher'));
    }

    public function cek_redeem_voucher(Request $request)
    {
        $voucher = $request->voucher;

        $redeem_voucher = RedeemVoucher::where('kode', $voucher)->first();

        $redeem_history = new RedeemHistory();
        $redeem_history->redeem_by = Auth::user()->id;
        $redeem_history->kode = $redeem_voucher ? $redeem_voucher->kode : $voucher;
        $redeem_history->save();
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

        $redeem_voucher = RedeemVoucher::find($request->id);
        $redeem_voucher->redeem_by = Auth::user()->id;
        $redeem_voucher->redeem_date = date('Y-m-d H:i:s');
        $redeem_voucher->status = 1;
        $redeem_voucher->save();

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
