<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCtsTable extends Migration
{
    public function up()
    {
        Schema::table('cts', function (Blueprint $table) {
            $table->unsignedBigInteger('point_1_id')->nullable();
            $table->foreign('point_1_id', 'point_1_fk_8231263')->references('id')->on('lines');
            $table->unsignedBigInteger('point_2_id')->nullable();
            $table->foreign('point_2_id', 'point_2_fk_8231264')->references('id')->on('lines');
        });
    }
}
