<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerUpdateAppointmentEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $code;
    protected $customer_name;
    protected $scheduled_at;
    protected $updated_at;
    protected $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code, $customer_name, $scheduled_at, $updated_at, $status)
    {
        $this->code          = $code;
        $this->customer_name = $customer_name;
        $this->scheduled_at  = $scheduled_at;
        $this->updated_at    = $updated_at;
        $this->status        = $status;
    }   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('anilifevet@gmail.com')
            ->markdown('email.customer-update-appointment')
            ->with([
                'code'          => $this->code,
                'customer_name' => $this->customer_name,
                'scheduled_at'  => $this->scheduled_at,
                'updated_at'    => $this->updated_at,
                'status'        => $this->status,
            ])
            ->subject("Anilife - Appointment Status Updated");
    }
}
