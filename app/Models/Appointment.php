<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'customer_name',
        'contact_no',
        'email_address',
        'appointment_details',
        'payment_option',
        'payment_amount',
        'payment_reference_no',
        'payment_screenshot',
        'status',
        'scheduled_at',
        'cancel_reason'
    ];
}
