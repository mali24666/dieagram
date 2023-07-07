<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranseformersTable extends Migration
{
    public function up()
    {
        Schema::create('transeformers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('t_no');
            $table->string('kva_rating')->nullable();
            $table->string('primary_voltage')->nullable();
            $table->string('sec_voltage')->nullable();
            $table->string('manuf_sno')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('manafac_year')->nullable();
            $table->string('over_load')->nullable();
            $table->string('rating')->nullable();
            $table->string('manufacturer_serial')->nullable();
            $table->string('circuits')->nullable();
            $table->string('no_of_used_circuits')->nullable();
            $table->string('manufacturer_minb')->nullable();
            $table->string('lv_cable')->nullable();
            $table->string('x_minb')->nullable();
            $table->string('y_minb')->nullable();
            $table->string('manuf')->nullable();
            $table->string('left_ss')->nullable();
            $table->string('right_ss')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('type')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
