<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRmusTable extends Migration
{
    public function up()
    {
        Schema::create('rmus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rmu_no')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
