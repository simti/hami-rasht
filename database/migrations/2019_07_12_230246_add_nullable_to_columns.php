<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donees', function($table)
        {
            $table->string('file_number',45)->nullable()->change();
            $table->string('full_name',90)->nullable()->change();
            $table->string('father_name',45)->nullable()->change();
            $table->integer('birth_date')->nullable()->change();
            $table->string('birth_certificate_id',10)->nullable()->change();
            $table->string('national_id',10)->nullable()->change();
            $table->string('bank_account_number')->nullable()->change();
            $table->string('bank_card_number',16)->nullable()->change();
            $table->string('bank_account_owner',90)->nullable()->change();
            $table->string('bank_name',45)->nullable()->change();
            $table->string('bank_branch_name',90)->nullable()->change();
            $table->string('education')->nullable()->change();
            $table->integer('membership_start_date')->nullable()->change();
            $table->string('address',1000)->nullable()->change();
            $table->string('phone',16)->nullable()->change();
            $table->string('mobile', 12)->nullable()->change();
            $table->smallInteger('organization_branch')->nullable()->change();
            $table->integer('number_of_disabled_members_in_family')->nullable()->change();
            $table->integer('number_of_family_members')->nullable()->change();
            $table->string('reasons_to_help',1000)->nullable()->change();

        });

        Schema::table('donors', function($table)
        {
          $table->string('full_name',90)->nullable()->change();
          $table->string('father_name',45)->nullable()->change();
          $table->string('birth_certificate_id',10)->nullable()->change();
          $table->string('national_id',10)->nullable()->change();
          $table->string('nationality',45)->nullable()->change();
          $table->string('state',45)->nullable()->change();
          $table->string('city',45)->nullable()->change();
          $table->string('phone',16)->nullable()->change();
          $table->string('mobile', 12)->nullable()->change();
          $table->string('religion')->nullable()->change();
          $table->string('education')->nullable()->change();
          $table->string('job')->nullable()->change();
          $table->integer('cooperation_start_date')->nullable()->change();
          $table->smallInteger('gender')->nullable()->change();
          $table->integer('birth_date')->nullable()->change();
          $table->string('address')->nullable()->change();
          $table->float('duration_of_support')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donees', function (Blueprint $table) {
            //
        });
        Schema::table('donors', function (Blueprint $table) {
          //
      });
    }
}
