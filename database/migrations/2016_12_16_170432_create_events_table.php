<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('name');
            $table->string('desc');
            $table->integer('capacity')->default(0);
            $table->boolean('public')->default(0);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->text('fields')->nullable();
            $table->string('cover')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('featured')->default(0);
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
        Schema::dropIfExists('events');
    }
}
