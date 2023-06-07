<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtDiagramPivotTable extends Migration
{
    public function up()
    {
        Schema::create('ct_diagram', function (Blueprint $table) {
            $table->unsignedBigInteger('diagram_id');
            $table->foreign('diagram_id', 'diagram_id_fk_8241863')->references('id')->on('diagrams')->onDelete('cascade');
            $table->unsignedBigInteger('ct_id');
            $table->foreign('ct_id', 'ct_id_fk_8241863')->references('id')->on('cts')->onDelete('cascade');
        });
    }
}
