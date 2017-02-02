<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BankingHistoryCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banking_history', function(Blueprint $table){
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->string('type');
          $table->double('amount');
          $table->double('bonus_amount')->nullable();
          $table->timestamps();
          $table->foreign('user_id')->references('id')->on('users');
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('banking_history');
    }
}
