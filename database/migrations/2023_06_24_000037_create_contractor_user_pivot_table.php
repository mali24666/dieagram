<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('contractor_user', function (Blueprint $table) {
            $table->unsignedBigInteger('contractor_id');
            $table->foreign('contractor_id', 'contractor_id_fk_7698615')->references('id')->on('contractors')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_7698615')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
