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
        Schema::create('colleges', function (Blueprint $table) {
            $table->string('college_id')->primary();
            $table->string('college_short_code')->unique();
            $table->string('college_name');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('address_id')->on('addresses')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('colleges', function (Blueprint $table) {
            $table->unique('college_id');
        });

        Schema::table('colleges', function (Blueprint $table) {
            $table->foreign('dept_short_code')
                ->references('college_id')->on('departments')
                ->onDelete('cascade');
        });

        Schema::table('colleges', function (Blueprint $table) {
            $table->foreign('staff_id')
                ->references('college_id')->on('staffs')
                ->onDelete('cascade');
        });

        Schema::table('colleges', function (Blueprint $table) {
            $table->foreign('student_id')
                ->references('college_id')->on('student_id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colleges');
    }
};
