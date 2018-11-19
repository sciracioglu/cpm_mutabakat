<?php

namespace App\Http\Controllers;

use TheSeer\Tokenizer\Exception;
use App\ARGMSJ;
use App\VWABBS;
use App\VWASRK;
use Illuminate\Support\Facades\Mail;
use App\Mail\BilgiMail;

class MesajController extends Controller
{
    public function index($id)
    {
        $data         = VWABBS::where('GUID', $id)->first();
        $firma        = VWASRK::where('SIRKETNO', $data->SIRKETNO)->first();
        return view('mesaj', compact('id', 'firma', 'data'));
    }

    public function store()
    {
        $data = request()->validate([
            'id'    => 'required',
            'mesaj' => 'required'
        ]);

        try {
            $this->haberVer();
            ARGMSJ::create([
                        'GUID'  => request('id'),
                        'MESAJ' => request('mesaj')
                    ]);
            $response['status'] = 1;
        } catch (Exception $e) {
            $response['status'] == -1;
        }

        return $response;
    }

    private function mesajGonderildi()
    {
        $data           = VWABBS::where('GUID', request('id'))->first();
        $unvan          = $data->UNVAN . ' ' . $data->UNVAN2;
        $email          = $data->EMAIL5;
        $veri['id']     = request('id');
        $veri['sirket'] = $data->SIRKETNO;
        $veri['mesaj']  = request('mesaj') . '<p>' . $unvan . '</p><p><a href="mailto:' . $email . '">' . $email . '</a></p>';

        return $veri;
    }

    private function haberVer()
    {
        $data               = $this->mesajGonderildi();
        $firma              = VWASRK::where('SIRKETNO', $data['sirket'])->first();
        $data['firma_mail'] = $firma->EMAIL;

        Mail::to($firma->EMAIL)
                ->send(new BilgiMail($data));
    }
}
