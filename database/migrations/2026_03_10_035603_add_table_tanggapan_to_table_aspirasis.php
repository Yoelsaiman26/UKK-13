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
        Schema::table('aspirasis', function (Blueprint $table) {
            $table->text('balasan')->nullable()->after('keterangan');
            $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending')->after('balasan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aspirasis', function (Blueprint $table) {
            $table->dropColumn('balasan');
            $table->dropColumn('status');
        });
    }
};
