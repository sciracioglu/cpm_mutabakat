<?php

namespace App\Http\Controllers;

use TheSeer\Tokenizer\Exception;
use App\ARGMSJ;

class MesajController extends Controller
{
    public function index($id)
    {
        return view('mesaj', compact('id'));
    }

    public function store()
    {
        $data = request()->validate([
            'id'    => 'required',
            'mesaj' => 'required'
        ]);

        try {
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
}
