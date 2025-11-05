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
        Schema::create('tbl_rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('tbl_cars')->onDelete('cascade');
            $table->string('customer_name');
            $table->date('rent_date');
            $table->date('return_date')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_rentals');
    }
};
