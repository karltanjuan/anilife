<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->tinyInteger('gender')->default(0); // Male = 0, Female = 1
            $table->string('email_address');
            $table->string('username');
            $table->text('password');
            $table->text('photo')->nullable();
            $table->string('contact_no');
            $table->string('address')->nullable();
            $table->string('position')->nullable();
            $table->tinyInteger('role')->default(3); // Admin = 1, Staff = 2, Customer = 3
            $table->tinyInteger('status')->default(0); // Inactive = 0, Active = 1
            $table->text('token')->nullable();
            $table->date('token_expired_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
