<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentAcknowledgementEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $code;
    protected $customer_name;
    protected $scheduled_at;
    protected $status;
    protected $payment_option;
    protected $payment_amount;
    protected $payment_reference_no;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code, $customer_name, $scheduled_at, $status, $payment_option, $payment_amount, $payment_reference_no)
    {
        $this->code           = $code;
        $this->customer_name  = $customer_name;
        $this->scheduled_at   = $scheduled_at;
        $this->status         = $status;
        $this->payment_option = $payment_option;
        $this->payment_amount = $payment_amount;
        $this->payment_reference_no = $payment_reference_no;
    }   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // anilife.vet.clinic@gmail.com
        return $this->from('anilifevet@gmail.com')
            ->markdown('email.payment-acknowledgement')
            ->with([
                'code'                 => $this->code,
                'customer_name'        => $this->customer_name,
                'scheduled_at'         => $this->scheduled_at,
                'status'               => $this->status,
                'payment_option'       => $this->payment_option,
                'payment_amount'       => $this->payment_amount,
                'payment_reference_no' => $this->payment_reference_no,
            ])
            ->subject("Anilife - Payment Acknowledgement");
    }
}
