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
        Schema::create('court_cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_no')->unique();
            $table->string('case_file_no');

            $table->string('title');
            $table->string('client_name');

            $table->date('started_date');
            $table->date('closed_date')->nullable();

            $table->unsignedBigInteger('court_id');
            $table->foreign('court_id')->references('id')->on('courts')->onDelete('cascade');

            $table->timestamps();

            $table->bigInteger('created_by_user_id')->unsigned()->nullable();
            $table->bigInteger('updated_by_user_id')->unsigned()->nullable();
            $table->bigInteger('deleted_by_user_id')->unsigned()->nullable();
            $table->foreign('created_by_user_id')->references('id')->on('users');
            $table->foreign('updated_by_user_id')->references('id')->on('users');
            $table->foreign('deleted_by_user_id')->references('id')->on('users');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_cases');
    }
};
