<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonorFundRaisersTable extends Migration
{
    public function up()
    {
        Schema::create('donor_fund_raisers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount');
            $table->string('caption')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
