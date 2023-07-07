<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserAlertsTable extends Migration
{
    public function up()
    {
        Schema::table('user_alerts', function (Blueprint $table) {
            $table->unsignedBigInteger('lices_no_id')->nullable();
            $table->foreign('lices_no_id', 'lices_no_fk_7614860')->references('id')->on('tasks');
            $table->unsignedBigInteger('order_by_id')->nullable();
            $table->foreign('order_by_id', 'order_by_fk_7712148')->references('id')->on('users');
        });
    }
}
