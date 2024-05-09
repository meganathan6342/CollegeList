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
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('address_id');
            $table->string('street_1');
            $table->string('street_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->timestamps();
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('student_id')
                ->references('address_id')->on('students')
                ->onDelete('cascade');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('staff_id')
                ->references('address_id')->on('staffs')
                ->onDelete('cascade');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('college_id')
                ->references('address_id')->on('colleges')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
