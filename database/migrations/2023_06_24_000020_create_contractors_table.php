<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorsTable extends Migration
{
    public function up()
    {
        Schema::create('contractors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('alert_text')->nullable();
            $table->datetime('site_ready')->nullable();
            $table->datetime('date_time')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
