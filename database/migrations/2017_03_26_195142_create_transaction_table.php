<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        // Create wallet's table.
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('amount');
            $table->integer('borrower')->unsigned()->nullable();
            $table->foreign('borrower')->references('id')->on('users')->onDelete('cascade');
            $table->integer('lender')->unsigned()->nullable();
            $table->foreign('lender')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('transactions');
    }
}
