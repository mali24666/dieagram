<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionLazyStationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('section_lazy_station', function (Blueprint $table) {
            $table->unsignedBigInteger('station_id');
            $table->foreign('station_id', 'station_id_fk_8656686')->references('id')->on('stations')->onDelete('cascade');
            $table->unsignedBigInteger('section_lazy_id');
            $table->foreign('section_lazy_id', 'section_lazy_id_fk_8656686')->references('id')->on('section_lazies')->onDelete('cascade');
        });
    }
}
