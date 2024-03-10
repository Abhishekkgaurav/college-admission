<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_tbl', function (Blueprint $table) {
            $table->id('enrollment_id');
            $table->string('applicant_name', 45);
            $table->string('fourth_optional', 10)->nullable();
            $table->date('enrollment_date')->default(now());
            $table->unsignedBigInteger('college_id');

            // Foreign key constraint
            $table->foreign('college_id')->references('college_id')->on('college_master');

            // Timestamps
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
        Schema::dropIfExists('admission_tbl');
    }
}
