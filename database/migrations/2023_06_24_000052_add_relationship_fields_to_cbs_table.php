<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCbsTable extends Migration
{
    public function up()
    {
        Schema::table('cbs', function (Blueprint $table) {
            $table->unsignedBigInteger('transe_id')->nullable();
            $table->foreign('transe_id', 'transe_fk_7400915')->references('id')->on('transeformers');
        });
    }
}
