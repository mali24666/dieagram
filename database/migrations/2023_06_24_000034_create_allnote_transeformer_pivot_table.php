<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllnoteTranseformerPivotTable extends Migration
{
    public function up()
    {
        Schema::create('allnote_transeformer', function (Blueprint $table) {
            $table->unsignedBigInteger('transeformer_id');
            $table->foreign('transeformer_id', 'transeformer_id_fk_7441903')->references('id')->on('transeformers')->onDelete('cascade');
            $table->unsignedBigInteger('allnote_id');
            $table->foreign('allnote_id', 'allnote_id_fk_7441903')->references('id')->on('allnotes')->onDelete('cascade');
        });
    }
}
