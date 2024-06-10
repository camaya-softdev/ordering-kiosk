<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Add outlet_id to orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('outlet_id')->after('product_id');
        });

        // Step 2: Copy outlet_id from transactions to orders
        DB::statement("
            UPDATE orders o
            JOIN transactions t ON o.transaction_id = t.id
            SET o.outlet_id = t.outlet_id
        ");

        // Step 3: Remove outlet_id from transactions table
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('outlet_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Step 1: Add outlet_id back to transactions table
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('outlet_id')->after('location_number_id');
        });

        // Step 2: Copy outlet_id from orders to transactions
        DB::statement("
            UPDATE transactions t
            JOIN orders o ON t.id = o.transaction_id
            SET t.outlet_id = o.outlet_id
        ");

        // Step 3: Remove outlet_id from orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('outlet_id');
        });
    }
};
