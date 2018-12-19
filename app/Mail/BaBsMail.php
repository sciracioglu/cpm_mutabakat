<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

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
        $aylar       = [1=>'Ocak', 2=>'Şubat', 3=>'Mart', 4=>'Nisan', 5=>'Mayıs', 6=>'Haziran', 7=>'Temmuz', 8=>'Ağustos', 9=>'Eylül', 10=>'Ekim', 11=>'Kasım', 12=>'Aralık'];
        $ay          = date('n');
        $this->tarih = date('Y') . ' / ' . $aylar[$ay];

        return $this->to($this->data->EMAIL5)
                    ->subject($this->data->SIRKETAD . ' BS Mütabakat')
                    ->view('mail.babs.bilgi');
    }
}
