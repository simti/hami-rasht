<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('transactions', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('donor_id')->index();
      $table->integer('donee_id')->index();
      $table->smallInteger('type')->default(1);
      $table->string('non_money_detail')->nullable();
      $table->integer('money_amount')->nullable();
      $table->integer('period_id')->index();
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
    Schema::dropIfExists('transactions');
  }
}
