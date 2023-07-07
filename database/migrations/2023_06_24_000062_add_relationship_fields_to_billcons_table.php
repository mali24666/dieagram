<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBillconsTable extends Migration
{
    public function up()
    {
        Schema::table('billcons', function (Blueprint $table) {
            $table->unsignedBigInteger('task_no_id')->nullable();
            $table->foreign('task_no_id', 'task_no_fk_7993003')->references('id')->on('tasks');
            $table->unsignedBigInteger('mokusa_id')->nullable();
            $table->foreign('mokusa_id', 'mokusa_fk_7993062')->references('id')->on('lics');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7993007')->references('id')->on('users');
        });
    }
}
