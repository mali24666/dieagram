<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBoxesTable extends Migration
{
    public function up()
    {
        Schema::table('boxes', function (Blueprint $table) {
            $table->unsignedBigInteger('minibller_no_id')->nullable();
            $table->foreign('minibller_no_id', 'minibller_no_fk_7400995')->references('id')->on('cbs');
            $table->unsignedBigInteger('trans_box_id')->nullable();
            $table->foreign('trans_box_id', 'trans_box_fk_8640236')->references('id')->on('transeformers');
        });
    }
}
