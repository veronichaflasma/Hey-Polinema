<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('feed_id');
            $table->foreign('feed_id', 'feed_fk_4879681')->references('id')->on('feeds');
            $table->unsignedBigInteger('sender_id');
            $table->foreign('sender_id', 'sender_fk_4879682')->references('id')->on('users');
        });
    }
}
