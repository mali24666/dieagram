<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCbsTable extends Migration
{
    public function up()
    {
        Schema::create('cbs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trans_cb_fider_number');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
