<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->string('staff_id')->primary();
            $table->string('staff_name');
            $table->char('staff_gender', 1);
            $table->date('staff_dob');
            $table->bigInteger('mobile_no');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('address_id')->on('addresses')->onDelete('cascade');
            $table->string('college_id');
            $table->foreign('college_id')->references('college_id')->on('colleges')->onDelete('cascade');
            $table->string('dept_short_code');
            $table->foreign('dept_short_code')->references('dept_short_code')->on('departments')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('staffs', function (Blueprint $table) {
            $table->unique('staff_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
