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
        Schema::create('case_statuses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('court_case_id');
            $table->foreign('court_case_id')->references('id')->on('court_cases')->onDelete('cascade');

            $table->tinyInteger('status')->default(0)->comment('0=>new, 1=>ongoing, 2=>completed');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_statuses');
    }
};
