<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtLinePivotTable extends Migration
{
    public function up()
    {
        Schema::create('ct_line', function (Blueprint $table) {
            $table->unsignedBigInteger('line_id');
            $table->foreign('line_id', 'line_id_fk_8247015')->references('id')->on('lines')->onDelete('cascade');
            $table->unsignedBigInteger('ct_id');
            $table->foreign('ct_id', 'ct_id_fk_8247015')->references('id')->on('cts')->onDelete('cascade');
        });
    }
}
