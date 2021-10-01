<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnerFundRaisersTable extends Migration
{
    public function up()
    {
        Schema::create('owner_fund_raisers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('caption');
            $table->decimal('fund', 15, 2)->nullable();
            $table->string('status')->nullable();
            $table->integer('days')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
