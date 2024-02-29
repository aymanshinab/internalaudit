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
        Schema::create('procedures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("transaction_id");
            $table->foreignId("employee_id")->nullable();
            $table->foreignId("user_id")->nullable();
            $table->foreignId("procedure_types_id");
            $table->integer('to_employee')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedures');
    }
};
