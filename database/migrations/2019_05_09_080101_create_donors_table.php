<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name',90);
            $table->string('father_name',45);
            $table->string('birth_certificate_id',10)->unique();
            $table->string('national_id',10)->unique();
            $table->string('nationality',45);
            $table->string('state',45);
            $table->string('city',45);
            $table->string('phone',16);
            $table->string('mobile', 12);
            $table->smallInteger('marital_status');
            $table->string('religion');
            $table->string('education');
            $table->string('job');
            $table->integer('cooperation_start_date');
            $table->smallInteger('gender');
            $table->integer('birth_date');
            $table->string('address');
            $table->float('duration_of_support');
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
        Schema::dropIfExists('donors');
    }
}
