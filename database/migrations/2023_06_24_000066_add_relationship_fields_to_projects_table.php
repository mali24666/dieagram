<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProjectsTable extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('name_id')->nullable();
            $table->foreign('name_id', 'name_fk_8642292')->references('id')->on('stations');
            $table->unsignedBigInteger('transefer_id')->nullable();
            $table->foreign('transefer_id', 'transefer_fk_8642297')->references('id')->on('transeformers');
            $table->unsignedBigInteger('feeder_id')->nullable();
            $table->foreign('feeder_id', 'feeder_fk_8642298')->references('id')->on('lines');
            $table->unsignedBigInteger('ct_id')->nullable();
            $table->foreign('ct_id', 'ct_fk_8642300')->references('id')->on('cts');
            $table->unsignedBigInteger('rmu_id')->nullable();
            $table->foreign('rmu_id', 'rmu_fk_8665363')->references('id')->on('rmus');
            $table->unsignedBigInteger('autorecloser_id')->nullable();
            $table->foreign('autorecloser_id', 'autorecloser_fk_8665364')->references('id')->on('autoreclosers');
            $table->unsignedBigInteger('sectionlazy_id')->nullable();
            $table->foreign('sectionlazy_id', 'sectionlazy_fk_8665365')->references('id')->on('section_lazies');
            $table->unsignedBigInteger('avr_id')->nullable();
            $table->foreign('avr_id', 'avr_fk_8665366')->references('id')->on('avrs');
        });
    }
}
