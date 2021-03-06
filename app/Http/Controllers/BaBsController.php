<?php

namespace App\Http\Controllers;

use App\VWABBS;
use App\Mail\BaBsMail;
use Illuminate\Support\Facades\Mail;
use App\VWADTY;
use App\VWASRK;
use App\ARGBYNBS;

class BaBsController extends Controller
{
    public function index()
    {
        $data = VWABBS::where('ISLEM', 0)
                        ->where('GONDERILDI', 0)
                        ->get();
        if ($data->count() > 0) {
            foreach ($data as $firma) {
                if ($firma->EMAIL5 && (filter_var($firma->EMAIL5, FILTER_VALIDATE_EMAIL))) {
                    Mail::to($firma->EMAIL5)
                        ->send(new BaBsMail($firma));
                }
                ARGBYNBS::where('GUID', $firma->GUID)->update([
                    'GONDERILDI' => 1
                ]);
            }
        }
    }

    public function show($id)
    {
        $data         = VWABBS::where('GUID', $id)->first();
        $firma        = VWASRK::where('SIRKETNO', $data->SIRKETNO)->first();
        $detay        = VWADTY::where('HESAPKOD', $data->HESAPKOD)
                                ->where('YIL', $data->YIL)
                                ->where('AY', $data->AY)
                                ->get();

        return view('babs.show', compact('data', 'detay', 'firma'));
    }

    public function store($id)
    {
        ARGBYNBS::where('GUID', $id)
                ->update([
                    'ACIKLAMA'    => 'Onaylandı',
                    'ISLEM'       => 1,
                    'ISLEMTARIH'  => date('Y-m-d H:i:s')
                ]);

        return back();
    }
}
