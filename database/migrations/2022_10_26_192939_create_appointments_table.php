<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('customer_name');
            $table->string('contact_no');
            $table->string('email_address');
            $table->text('appointment_details');
            $table->string('payment_option');
            $table->string('payment_amount');
            $table->string('payment_reference_no')->nullable();
            $table->text('payment_screenshot')->nullable();
            $table->dateTime('scheduled_at');
            // Pending - 0, Confirmed - 1, Canceled = 2, Completed = 3
            $table->tinyInteger('status')->default(0);
            $table->string('cancel_reason')->nullable(); // if status is 2 or 3
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
