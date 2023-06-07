<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToContractorsTable extends Migration
{
    public function up()
    {
        Schema::table('contractors', function (Blueprint $table) {
            $table->unsignedBigInteger('lices_no_id')->nullable();
            $table->foreign('lices_no_id', 'lices_no_fk_7698616')->references('id')->on('tasks');
        });
    }
}
