<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRmusTable extends Migration
{
    public function up()
    {
        Schema::table('rmus', function (Blueprint $table) {
            $table->unsignedBigInteger('rmu_feeder_id')->nullable();
            $table->foreign('rmu_feeder_id', 'rmu_feeder_fk_8656543')->references('id')->on('lines');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8656527')->references('id')->on('users');
        });
    }
}
