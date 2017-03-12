<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageColToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // Create image column in posts table.
        Schema::table('posts', function (Blueprint $table) {
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
