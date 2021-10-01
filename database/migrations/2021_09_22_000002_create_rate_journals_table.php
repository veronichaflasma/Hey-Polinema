<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateJournalsTable extends Migration
{
    public function up()
    {
        Schema::create('rate_journals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rate');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
