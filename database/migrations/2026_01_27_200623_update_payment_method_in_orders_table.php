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
        // Modify payment_method to allow "stripe" and "cash"
        Schema::table('orders', function (Blueprint $table) {
            // Option A: If you use ENUM
            $table->enum('payment_method', ['stripe', 'cash'])->default('stripe')->change();

            // Option B: If you want more flexibility, use VARCHAR
            // $table->string('payment_method', 20)->default('stripe')->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Revert to previous ENUM or VARCHAR (adjust to your original type)
            $table->enum('payment_method', ['card','cash'])->default('card')->change();

            // Or for VARCHAR
            // $table->string('payment_method', 10)->default('card')->change();
        });
    }
};
