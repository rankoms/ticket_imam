<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ScannerController;
use App\Models\Barcode;
use App\Models\Ticket;
use App\Rules\ExceptSymbol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{

    public function dashboard_ticket(Request $request)
    {
        $ticket = Barcode::orderBy('category_name', 'asc')->get();

        $jumlah_pending = 0;
        $jumlah_checkin = 0;
        $jumlah_checkout = 0;
        $kategory_aset = [];
        foreach ($ticket as $key => $value) :
            if ($value->barcode_scan_status == 1001) :
                $jumlah_pending++;
                isset($kategory_aset[$value->category_name]['checkin']) ? $kategory_aset[$value->category_name]['checkin']++ : $kategory_aset[$value->category_name]['checkin'] = 1;
            endif;
            if ($value->barcode_scan_status == 1019) :
                $jumlah_checkin++;
                isset($kategory_aset[$value->category_name]['checkin']) ? $kategory_aset[$value->category_name]['checkin']++ : $kategory_aset[$value->category_name]['checkin'] = 1;
            endif;
            if ($value->barcode_scan_status == 1020) :
                $jumlah_checkout++;
                isset($kategory_aset[$value->category_name]['checkout']) ? $kategory_aset[$value->category_name]['checkout']++ : $kategory_aset[$value->category_name]['checkout'] = 1;
            endif;
        endforeach;
        return view('admin.dashboard_ticket', compact('kategory_aset', 'jumlah_pending', 'jumlah_checkin', 'jumlah_checkout', 'ticket'));
    }
}
