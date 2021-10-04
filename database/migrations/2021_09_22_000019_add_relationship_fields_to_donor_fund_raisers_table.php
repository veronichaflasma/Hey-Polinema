<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDonorFundRaisersTable extends Migration
{
    public function up()
    {
        Schema::table('donor_fund_raisers', function (Blueprint $table) {
            $table->unsignedBigInteger('fundraiser_id');
            $table->foreign('fundraiser_id', 'fundraiser_fk_4930777')->references('id')->on('owner_fund_raisers');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4930798')->references('id')->on('users');
        });
    }
}
