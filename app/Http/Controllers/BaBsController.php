<?php

namespace App\Http\Controllers;

use App\VWABBS;
use App\Mail\BaBsMail;
use Illuminate\Support\Facades\Mail;
use App\VWADTY;
use App\BYNODE;
use App\VWASRK;

class BaBsController extends Controller
{
    public function logo($id)
    {
        $data         = VWABBS::where('GUID', $id)->first();
        $firma        = VWASRK::where('SIRKETNO', $data->SIRKETNO)->first();
        header('Content-type: image/jpeg');
        return $firma->RESIM;
    }

    public function index()
    {
        $data = VWABBS::where('ISLEM', 0)->first();
        Mail::to($data->EMAIL1)
                ->send(new BaBsMail($data));
    }

    public function show($id)
    {
        $data         = VWABBS::where('GUID', $id)->first();
        $firma        = VWASRK::where('SIRKETNO', $data->SIRKETNO)->first();
        $detay        = VWADTY::where('HESAPKOD', $data->HESAPKOD)
                        ->where('YIL', $data->YIL)
                        ->get();
        return view('show', compact('data', 'detay', 'firma'));
    }

    public function store($id)
    {
        BYNODE::where('GUID', $id)
                ->update([
                    'ACIKLAMA'    => 'Onaylandı',
                    'ISLEM'       => 1,
                    'ISLEMTARIH'  => date('Y-m-d H:i:s')
                ]);
        return back();
    }
}
