<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillconsTable extends Migration
{
    public function up()
    {
        Schema::create('billcons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_1');
            $table->string('job_2')->nullable();
            $table->string('job_3')->nullable();
            $table->float('count_1', 15, 2)->nullable();
            $table->float('count_2', 15, 2)->nullable();
            $table->float('count_3', 15, 2)->nullable();
            $table->float('totall', 15, 2)->nullable();
            $table->float('totall_2', 15, 2)->nullable();
            $table->float('totall_3', 15, 2)->nullable();
            $table->float('totall_4', 15, 2)->nullable();
            $table->string('account_department')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
