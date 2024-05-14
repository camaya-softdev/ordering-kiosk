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
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('reference_number')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'voided', 'completed'])->default('pending');
            $table->string('remarks')->nullable();
            $table->enum('dining_option', ['dine-in', 'pick-up', 'delivery'])->default('dine-in');
            $table->string('payment_method')->default('cash');
            $table->unsignedBigInteger('outlet_id');
            $table->unsignedBigInteger('location_number_id')->nullable();
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
