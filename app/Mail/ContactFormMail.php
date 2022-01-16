<?php

namespace App\Mail;

use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

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
        return $this->markdown('site.vendor.contactform')->with([
            'vendor_id' => $this->data['vendor_id'],
            'email' => $this->data['email'],
            'phone_number' => $this->data['phone_number'],
            'address_request' => $this->data['address_request'],
            'message' => $this->data['message'],
        ]);
    }
}
