<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationTranseformerPivotTable extends Migration
{
    public function up()
    {
        Schema::create('station_transeformer', function (Blueprint $table) {
            $table->unsignedBigInteger('station_id');
            $table->foreign('station_id', 'station_id_fk_8253747')->references('id')->on('stations')->onDelete('cascade');
            $table->unsignedBigInteger('transeformer_id');
            $table->foreign('transeformer_id', 'transeformer_id_fk_8253747')->references('id')->on('transeformers')->onDelete('cascade');
        });
    }
}
