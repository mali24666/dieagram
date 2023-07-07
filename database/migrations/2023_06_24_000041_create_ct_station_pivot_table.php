<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtStationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('ct_station', function (Blueprint $table) {
            $table->unsignedBigInteger('station_id');
            $table->foreign('station_id', 'station_id_fk_8656500')->references('id')->on('stations')->onDelete('cascade');
            $table->unsignedBigInteger('ct_id');
            $table->foreign('ct_id', 'ct_id_fk_8656500')->references('id')->on('cts')->onDelete('cascade');
        });
    }
}
