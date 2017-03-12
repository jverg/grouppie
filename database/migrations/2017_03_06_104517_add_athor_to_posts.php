<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAthorToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        // Create author's column.
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });

        // Reference each post with a user id.
        Schema::table('posts', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
