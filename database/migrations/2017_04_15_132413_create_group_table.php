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

        // Add foreign keys for groups in posts and users.
        $tables = array('posts', 'users');
        foreach ($tables as $table){
            // Create group_id column in users and posts table.
            Schema::table($table, function (Blueprint $table) {
                $table->integer('group_id')->unsigned()->nullable();
                $table->foreign('group_id')
                    ->references('id')
                    ->on('groups')
                    ->onDelete('cascade');
            });
        }
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
