<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinibllarnoteMinibllerPivotTable extends Migration
{
    public function up()
    {
        Schema::create('minibllarnote_minibller', function (Blueprint $table) {
            $table->unsignedBigInteger('minibller_id');
            $table->foreign('minibller_id', 'minibller_id_fk_7441940')->references('id')->on('minibllers')->onDelete('cascade');
            $table->unsignedBigInteger('minibllarnote_id');
            $table->foreign('minibllarnote_id', 'minibllarnote_id_fk_7441940')->references('id')->on('minibllarnotes')->onDelete('cascade');
        });
    }
}
