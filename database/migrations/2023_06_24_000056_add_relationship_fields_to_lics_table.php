<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLicsTable extends Migration
{
    public function up()
    {
        Schema::table('lics', function (Blueprint $table) {
            $table->unsignedBigInteger('head_eng_id')->nullable();
            $table->foreign('head_eng_id', 'head_eng_fk_7614618')->references('id')->on('users');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7598613')->references('id')->on('users');
        });
    }
}
