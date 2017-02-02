<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpgradeUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table){
          $table->increments('id');
          $table->string('email',150)->unique();
          $table->string('first_name');
          $table->string('last_name');
          $table->string('gender',1);
          $table->string('country',2);
          $table->double('bonus',15,8);
          $table->integer('deposit_period');
          $table->double('balance',15,2);
          $table->double('bonus_balance',15,2);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
