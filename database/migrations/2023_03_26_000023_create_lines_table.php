<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinesTable extends Migration
{
    public function up()
    {
        Schema::create('lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('line_no')->nullable();
            // $table->foreign('station_id')->references('id')->on('stations')->onDelete('cascade');
            // $table->bigInteger('station_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }
}
