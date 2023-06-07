<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinibllersTable extends Migration
{
    public function up()
    {
        Schema::create('minibllers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('minibller_number');
            $table->string('minibller_x')->nullable();
            $table->string('minibller_y')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
