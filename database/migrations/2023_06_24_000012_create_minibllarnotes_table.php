<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinibllarnotesTable extends Migration
{
    public function up()
    {
        Schema::create('minibllarnotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('notes')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
