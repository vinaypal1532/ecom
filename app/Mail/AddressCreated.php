<?php

namespace App\Mail;

use App\Models\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddressCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    public function build()
    {
        return $this->view('emails.addressCreated')
                    ->subject('New Address Created');
    }
}

