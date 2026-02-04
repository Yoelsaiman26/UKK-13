<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            if (!Schema::hasColumn('siswas', 'jurusan_id')) {
                $table->foreignId('jurusan_id')
                      ->nullable()
                      ->after('id')
                      ->constrained('jurusans')
                      ->nullOnDelete();
            }

            if (!Schema::hasColumn('siswas', 'profile')) {
                $table->string('profile')->nullable()->after('nama');
            }
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            if (Schema::hasColumn('siswas', 'jurusan_id')) {
                $table->dropForeign(['jurusan_id']);
                $table->dropColumn('jurusan_id');
            }

            if (Schema::hasColumn('siswas', 'profile')) {
                $table->dropColumn('profile');
            }
        });
    }
};
