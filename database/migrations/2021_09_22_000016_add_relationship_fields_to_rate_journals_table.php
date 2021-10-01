<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRateJournalsTable extends Migration
{
    public function up()
    {
        Schema::table('rate_journals', function (Blueprint $table) {
            $table->unsignedBigInteger('journal_id');
            $table->foreign('journal_id', 'journal_fk_4930800')->references('id')->on('journals');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4930801')->references('id')->on('users');
        });
    }
}
