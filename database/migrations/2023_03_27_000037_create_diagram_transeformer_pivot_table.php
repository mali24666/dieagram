<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagramTranseformerPivotTable extends Migration
{
    public function up()
    {
        Schema::create('diagram_transeformer', function (Blueprint $table) {
            $table->unsignedBigInteger('diagram_id');
            $table->foreign('diagram_id', 'diagram_id_fk_8241864')->references('id')->on('diagrams')->onDelete('cascade');
            $table->unsignedBigInteger('transeformer_id');
            $table->foreign('transeformer_id', 'transeformer_id_fk_8241864')->references('id')->on('transeformers')->onDelete('cascade');
        });
    }
}
