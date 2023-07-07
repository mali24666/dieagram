<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineStationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('line_station', function (Blueprint $table) {
            $table->unsignedBigInteger('station_id');
            $table->foreign('station_id', 'station_id_fk_8241837')->references('id')->on('stations')->onDelete('cascade');
            $table->unsignedBigInteger('line_id');
            $table->foreign('line_id', 'line_id_fk_8241837')->references('id')->on('lines')->onDelete('cascade');
        });
    }
}
