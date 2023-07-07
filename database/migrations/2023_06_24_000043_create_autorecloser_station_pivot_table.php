<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorecloserStationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('autorecloser_station', function (Blueprint $table) {
            $table->unsignedBigInteger('station_id');
            $table->foreign('station_id', 'station_id_fk_8656685')->references('id')->on('stations')->onDelete('cascade');
            $table->unsignedBigInteger('autorecloser_id');
            $table->foreign('autorecloser_id', 'autorecloser_id_fk_8656685')->references('id')->on('autoreclosers')->onDelete('cascade');
        });
    }
}
