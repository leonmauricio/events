<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_mail');
            $table->string('guest_mail');
            $table->string('guest_name');
            $table->string('event_name');
            $table->string('message');
            $table->boolean('sent')->default(0);
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
        Schema::dropIfExists('mailer');
    }
}
