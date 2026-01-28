<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    public function __construct(
        public $order,
        public $cartItems,
        public $subtotal,
        public $extraCharge,
        public $grandTotal,
        public $pdf
    ) {}

    public function build()
    {
        return $this->subject('🛍️ Your Order Confirmation')
            ->view('emails.order')
            ->attachData(
                $this->pdf->output(),
                'invoice_'.$this->order->id.'.pdf'
            );
    }
}

