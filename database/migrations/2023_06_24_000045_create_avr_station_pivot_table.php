<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvrStationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('avr_station', function (Blueprint $table) {
            $table->unsignedBigInteger('station_id');
            $table->foreign('station_id', 'station_id_fk_8656705')->references('id')->on('stations')->onDelete('cascade');
            $table->unsignedBigInteger('avr_id');
            $table->foreign('avr_id', 'avr_id_fk_8656705')->references('id')->on('avrs')->onDelete('cascade');
        });
    }
}
