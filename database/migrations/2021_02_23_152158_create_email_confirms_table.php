<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailConfirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_confirms', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('email_confirmable_id')->index();
            $table->string('email_confirmable_type')->index();

            $table->string('confirm_token');

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
        Schema::dropIfExists('email_confirms');
    }
}
