<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoneeDonerTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('donee_donor', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('donor_id')->unsigned()->index();
      $table->foreign('donor_id')->references('id')->on('donors')->onDelete('cascade');
      $table->integer('donee_id')->unsigned()->index();
      $table->foreign('donee_id')->references('id')->on('donees')->onDelete('cascade');
      $table->integer('donation_type')->default(1);
      $table->integer('money_amount')->default(0);
      $table->string('non_money_detail')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('donee_donor');
  }
}
