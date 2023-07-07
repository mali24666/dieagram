<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllnotesTable extends Migration
{
    public function up()
    {
        Schema::create('allnotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('t_notes')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
