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
        Schema::create('case_belong_courts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('court_id');
            $table->foreign('court_id')->references('id')->on('courts')->onDelete('cascade');

            $table->date('from');
            $table->date('to')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_belong_courts');
    }
};
