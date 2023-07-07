<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvrsTable extends Migration
{
    public function up()
    {
        Schema::create('avrs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('avr_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
