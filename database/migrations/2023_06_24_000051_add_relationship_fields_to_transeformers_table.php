<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTranseformersTable extends Migration
{
    public function up()
    {
        Schema::table('transeformers', function (Blueprint $table) {
            $table->unsignedBigInteger('cb_no_id')->nullable();
            $table->foreign('cb_no_id', 'cb_no_fk_7558536')->references('id')->on('cbs');
            $table->unsignedBigInteger('feeder_id')->nullable();
            $table->foreign('feeder_id', 'feeder_fk_8247016')->references('id')->on('lines');
        });
    }
}
