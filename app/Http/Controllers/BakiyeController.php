<?php

namespace App\Http\Controllers;

use App\VWABBS;
use App\Mail\BaBsMail;
use Illuminate\Support\Facades\Mail;
use App\VWADTY;
use App\BYNODE;
use App\VWASRK;
use App\ARGBMB;
use App\VWARGBMB;
use App\VWABMD;

class BakiyeController extends Controller
{
    public function index()
    {
        $data = VWARGBMB::where('ISLEM', 0)
                        ->where('GONDERILDI', 0)
                        ->get();
        if ($data->count() > 0) {
            foreach ($data as $firma) {
                Mail::to($firma->EMAIL5)
                        ->send(new BaBsMail($firma));
                ARGBMB::where('GUID', $firma->GUID)->update([
                    'GONDERILDI' => 1
                ]);
            }
        }
    }

    public function show($id)
    {
        $data         = ARGBMB::where('GUID', $id)->first();
        $firma        = VWASRK::where('SIRKETNO', $data->SIRKETNO)->first();
        $detay        = VWABMD::where('HESAPKOD', $data->HESAPKOD)
                                ->get();
        return view('bakiye.show', compact('data', 'detay', 'firma'));
    }

    public function store($id)
    {
        ARGBMB::where('GUID', $id)
                ->update([
                    'ACIKLAMA'    => 'Onaylandı',
                    'ISLEM'       => 1,
                    'ISLEMTARIH'  => date('Y-m-d H:i:s')
                ]);
        return back();
    }
}
