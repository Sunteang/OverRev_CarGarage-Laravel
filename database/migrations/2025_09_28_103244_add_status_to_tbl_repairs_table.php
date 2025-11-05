<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tbl_repairs', function (Blueprint $table) {
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])
                ->default('pending')
                ->after('repair_date');
        });
    }

    public function down()
    {
        Schema::table('tbl_repairs', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
