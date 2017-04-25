<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        // Create groups table.
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('admin')->unsigned();
            $table->foreign('admin')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Create author's column.
        Schema::table('users', function (Blueprint $table) {
            $table->integer('gid')->unsigned()->nullable();
            $table->foreign('gid')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('groups');
    }
}