<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class OrderInvoiceMail extends Mailable
{
    public $order;
    public $pdfPath;

    public function __construct($order, $pdfPath)
    {
        $this->order = $order;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->subject('New Order Invoice - ' . $this->order->order_number)
            ->view('emails.orders.invoice')
            ->attach($this->pdfPath, [
                'as' => 'Invoice_' . now()->format('d-M-Y_h-i-s_A') . '.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}

