<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ground')->nullable();
            $table->string('line')->nullable();
            $table->string('power_detected')->nullable();
            $table->string('panal')->nullable();
            $table->string('reading')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
