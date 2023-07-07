<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->integer('copy')->nullable();
            $table->date('start_time')->nullable();
            $table->date('due_date')->nullable();
            $table->float('length_total', 15, 2)->nullable();
            $table->date('extract')->nullable();
            $table->string('city')->nullable();
            $table->string('streat')->nullable();
            $table->string('stuts')->nullable();
            $table->boolean('check_1')->default(0)->nullable();
            $table->string('move_to_con_date')->nullable();
            $table->string('esfelt_done')->nullable();
            $table->string('enjaz')->nullable();
            $table->string('close_done')->nullable();
            $table->string('enjaz_stuts')->nullable();
            $table->string('con')->nullable();
            $table->boolean('check_2')->default(0)->nullable();
            $table->timestamps();
        });
    }
}
