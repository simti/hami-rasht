<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoneesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_number',45);
            $table->string('full_name',90);
            $table->string('father_name',45);
            $table->integer('birth_date');
            $table->string('birth_certificate_id',10)->unique();
            $table->string('national_id',10)->unique();
            $table->string('bank_account_number');
            $table->string('bank_card_number',16);
            $table->string('bank_account_owner',90);
            $table->string('bank_name',45);
            $table->string('bank_branch_name',45);
            $table->string('education');
            $table->smallInteger('gender');
            $table->integer('membership_start_date');
            $table->string('address');
            $table->string('phone',16);
            $table->string('mobile', 12);
            $table->smallInteger('organization_branch');
            $table->integer('number_of_disabled_members_in_family');
            $table->integer('number_of_family_members');
            $table->boolean('disabled');
            $table->string('reasons_to_help');
            $table->smallInteger('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('donees');
    }
}
