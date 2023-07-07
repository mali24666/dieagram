<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRmuStationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('rmu_station', function (Blueprint $table) {
            $table->unsignedBigInteger('station_id');
            $table->foreign('station_id', 'station_id_fk_8656684')->references('id')->on('stations')->onDelete('cascade');
            $table->unsignedBigInteger('rmu_id');
            $table->foreign('rmu_id', 'rmu_id_fk_8656684')->references('id')->on('rmus')->onDelete('cascade');
        });
    }
}
