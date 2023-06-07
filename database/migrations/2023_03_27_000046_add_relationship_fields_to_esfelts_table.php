<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEsfeltsTable extends Migration
{
    public function up()
    {
        Schema::table('esfelts', function (Blueprint $table) {
            $table->unsignedBigInteger('lics_no_id')->nullable();
            $table->foreign('lics_no_id', 'lics_no_fk_7602951')->references('id')->on('tasks');
            $table->unsignedBigInteger('eng_id')->nullable();
            $table->foreign('eng_id', 'eng_fk_7614767')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7946485')->references('id')->on('users');
        });
    }
}
