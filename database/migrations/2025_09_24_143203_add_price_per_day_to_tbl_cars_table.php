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
        Schema::table('tbl_cars', function (Blueprint $table) {
            $table->decimal('price_per_day', 10, 2)->nullable()->after('status');
            $table->decimal('sale_price', 10, 2)->nullable()->after('price_per_day');
            $table->enum('car_type', ['rental', 'sale'])->default('rental')->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('tbl_cars', function (Blueprint $table) {
            $table->dropColumn(['price_per_day', 'sale_price', 'car_type']);
        });
    }
};
