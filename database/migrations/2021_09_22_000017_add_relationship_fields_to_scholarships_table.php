<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToScholarshipsTable extends Migration
{
    public function up()
    {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4930793')->references('id')->on('users');
        });
    }
}
