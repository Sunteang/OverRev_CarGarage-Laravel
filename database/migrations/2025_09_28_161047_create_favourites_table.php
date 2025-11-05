<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tbl_favourites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('tbl_users')->onDelete('cascade');
            $table->foreignId('car_id')->constrained('tbl_cars')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'car_id']); // prevent duplicates
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_favourites');
    }
};
