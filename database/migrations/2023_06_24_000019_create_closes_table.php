<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClosesTable extends Migration
{
    public function up()
    {
        Schema::create('closes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('check')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
