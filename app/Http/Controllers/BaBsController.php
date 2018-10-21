<?php

namespace App\Http\Controllers;

use App\VWABBS;
use App\Mail\BaBsMail;
use Illuminate\Support\Facades\Mail;
use App\VWADTY;
use App\BYNODE;
use App\ARGMSJ;

class BaBsController extends Controller
{
    public function index()
    {
        $data = VWABBS::where('ISLEM', 0)->first();
        Mail::to('sciracioglu@gmail.com') //($data->EMAIL1)
                ->send(new BaBsMail($data));
    }

    public function show($id)
    {
        $data  = VWABBS::where('GUID', $id)->first();
        $detay = VWADTY::where('HESAPKOD', $data->HESAPKOD)
                        ->where('YIL', $data->YIL)
                        ->get();
        return view('show', compact('data', 'detay'));
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

    public function bilgi($id)
    {
        ARGMSJ::create([
            'GUID'  => $id,
            'MESAJ' => 'Mesaj'
        ]);

        return back();
    }
}
