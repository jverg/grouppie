<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoreUserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create author's column.
        Schema::table('users', function (Blueprint $table) {
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('address')->nullable();
            $table->timestamp('birthday')->nullable();
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
