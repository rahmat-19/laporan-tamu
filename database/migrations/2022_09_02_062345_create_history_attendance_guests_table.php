<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryAttendanceGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_attendance_guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->json('keperluan');
            $table->string('rak');
            $table->dateTime('masuk');
            $table->dateTime('keluar')->nullable();
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
        Schema::dropIfExists('history_attendance_guests');
    }
}
