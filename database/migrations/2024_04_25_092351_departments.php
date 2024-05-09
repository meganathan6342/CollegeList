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
        Schema::create('departments', function (Blueprint $table) {
            $table->string('dept_short_code')->primary();
            $table->string('dept_name');
            $table->string('college_id');
            $table->foreign('college_id')->references('college_id')->on('colleges')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->unique('dept_short_code');
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->foreign('staff_id')
                ->references('dept_short_code')->on('staff_id')
                ->onDelete('cascade');
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->foreign('student_id')
                ->references('dept_short_code')->on('student_id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
