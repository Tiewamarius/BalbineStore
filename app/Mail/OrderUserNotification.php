<?php

namespace App\Mail;

use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderUserNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Orders $order)
    {
        $this->order = $order->load('items.product');
    }

    public function build()
    {
        return $this->subject('Confirmation de votre commande #' . $this->order->order_number)
            ->view('emails.order_user');
    }
}
