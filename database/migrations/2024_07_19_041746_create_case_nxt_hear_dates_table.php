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
        Schema::create('case_nxt_hear_dates', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('court_case_id');
            $table->foreign('court_case_id')->references('id')->on('court_cases')->onDelete('cascade');

            $table->date('nxt_hear_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_nxt_hear_dates');
    }
};
