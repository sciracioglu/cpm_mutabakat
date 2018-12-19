<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class BaBsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $tarih;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $date = Carbon::now()->loacale('tr_TR');

        $this->tarih = $date->year . ' / ' . $date->monthName;

        return $this->to($this->data->EMAIL5)
                    ->subject($this->data->SIRKETAD . ' BS Mütabakat')
                    ->view('mail.babs.bilgi');
    }
}
