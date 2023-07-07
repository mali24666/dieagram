<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxStationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('box_station', function (Blueprint $table) {
            $table->unsignedBigInteger('station_id');
            $table->foreign('station_id', 'station_id_fk_8656456')->references('id')->on('stations')->onDelete('cascade');
            $table->unsignedBigInteger('box_id');
            $table->foreign('box_id', 'box_id_fk_8656456')->references('id')->on('boxes')->onDelete('cascade');
        });
    }
}
