<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicsTable extends Migration
{
    public function up()
    {
        Schema::create('lics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('department')->nullable();
            $table->string('license_no')->nullable();
            $table->date('esnad');
            $table->date('datestary')->nullable();
            $table->date('date_end')->nullable();
            $table->string('city')->nullable();
            $table->string('longtude')->nullable();
            $table->string('stuts')->nullable();
            $table->integer('e_length')->nullable();
            $table->integer('t_length')->nullable();
            $table->float('sarameek', 15, 2)->nullable();
            $table->string('wide')->nullable();
            $table->string('deep')->nullable();
            $table->string('head_eng_sign')->nullable();
            $table->string('order_stauts')->nullable();
            $table->float('naseg_no', 15, 2)->nullable();
            $table->string('task_number')->nullable();
            $table->timestamps();
        });
    }
}
