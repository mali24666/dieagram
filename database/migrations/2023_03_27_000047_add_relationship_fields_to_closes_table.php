<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClosesTable extends Migration
{
    public function up()
    {
        Schema::table('closes', function (Blueprint $table) {
            $table->unsignedBigInteger('lices_no_id')->nullable();
            $table->foreign('lices_no_id', 'lices_no_fk_7605461')->references('id')->on('tasks');
        });
    }
}
