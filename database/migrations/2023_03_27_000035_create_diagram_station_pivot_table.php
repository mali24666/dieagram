<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagramStationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('diagram_station', function (Blueprint $table) {
            $table->unsignedBigInteger('diagram_id');
            $table->foreign('diagram_id', 'diagram_id_fk_8241862')->references('id')->on('diagrams')->onDelete('cascade');
            $table->unsignedBigInteger('station_id');
            $table->foreign('station_id', 'station_id_fk_8241862')->references('id')->on('stations')->onDelete('cascade');
        });
    }
}
