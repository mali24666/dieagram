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
            $table->foreign('minibller_no_id', 'minibller_no_fk_7400995')->references('id')->on('minibllers');
        });
    }
}
