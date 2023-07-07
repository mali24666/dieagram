<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineTranseformerPivotTable extends Migration
{
    public function up()
    {
        Schema::create('line_transeformer', function (Blueprint $table) {
            $table->unsignedBigInteger('line_id');
            $table->foreign('line_id', 'line_id_fk_8241836')->references('id')->on('lines')->onDelete('cascade');
            $table->unsignedBigInteger('transeformer_id');
            $table->foreign('transeformer_id', 'transeformer_id_fk_8241836')->references('id')->on('transeformers')->onDelete('cascade');
        });
    }
}
