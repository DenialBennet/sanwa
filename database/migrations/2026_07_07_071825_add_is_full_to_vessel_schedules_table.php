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
        Schema::table('vessel_schedules', function (Blueprint $table) {
            $table->boolean('is_full')->default(false)->after('closing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vessel_schedules', function (Blueprint $table) {
            $table->dropColumn('is_full');
        });
    }
};
