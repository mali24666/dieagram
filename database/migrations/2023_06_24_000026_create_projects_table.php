<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('station')->nullable();
            $table->string('top')->nullable();
            $table->string('left')->nullable();
            $table->string('descreption')->nullable();
            $table->string('second_feeder')->nullable();
            $table->string('ct_postion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
