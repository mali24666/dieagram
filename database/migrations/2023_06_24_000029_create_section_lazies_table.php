<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionLaziesTable extends Migration
{
    public function up()
    {
        Schema::create('section_lazies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('section_lazey')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
