<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMinibllersTable extends Migration
{
    public function up()
    {
        Schema::table('minibllers', function (Blueprint $table) {
            $table->unsignedBigInteger('cb_number_id')->nullable();
            $table->foreign('cb_number_id', 'cb_number_fk_7400940')->references('id')->on('cbs');
        });
    }
}
