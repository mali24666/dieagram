<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBillsTable extends Migration
{
    public function up()
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->unsignedBigInteger('transformer_id')->nullable();
            $table->foreign('transformer_id', 'transformer_fk_7409196')->references('id')->on('transeformers');
        });
    }
}
