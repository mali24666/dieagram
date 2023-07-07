<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoreclosersTable extends Migration
{
    public function up()
    {
        Schema::create('autoreclosers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('auto_recloser_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
