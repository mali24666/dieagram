<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxesTable extends Migration
{
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('box_number');
            $table->string('box_type');
            $table->string('box_location')->nullable();
            $table->string('box_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
