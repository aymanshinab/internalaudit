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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('transactions_type')->default(1);
            $table->integer('year');
            $table->foreignId('management_id');
            $table->string('month');
            $table->string('data');
            $table->integer('to_employee')->nullable();
            $table->string('type');
            $table->integer('idnum')->nullable();
            $table->integer('summary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
