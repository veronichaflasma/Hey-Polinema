<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOwnerFundRaisersTable extends Migration
{
    public function up()
    {
        Schema::table('owner_fund_raisers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4930753')->references('id')->on('users');
        });
    }
}
