<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxTranseformerPivotTable extends Migration
{
    public function up()
    {
        Schema::create('box_transeformer', function (Blueprint $table) {
            $table->unsignedBigInteger('transeformer_id');
            $table->foreign('transeformer_id', 'transeformer_id_fk_8665642')->references('id')->on('transeformers')->onDelete('cascade');
            $table->unsignedBigInteger('box_id');
            $table->foreign('box_id', 'box_id_fk_8665642')->references('id')->on('boxes')->onDelete('cascade');
        });
    }
}
