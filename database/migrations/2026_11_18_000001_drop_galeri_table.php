<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Safely drop galeri table if it exists after checking dependencies.
     */
    public function up(): void
    {
        if (Schema::hasTable('galeri')) {
            // Backup table data to storage if any rows exist
            try {
                $rows = DB::table('galeri')->get();
                if ($rows->isNotEmpty()) {
                    $backupPath = storage_path('app/backup_galeri_' . date('Y_m_d_His') . '.json');
                    file_put_contents($backupPath, $rows->toJson(JSON_PRETTY_PRINT));
                }
            } catch (\Throwable $e) {
                // Ignore backup error if table is inaccessible
            }

            Schema::dropIfExists('galeri');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('galeri')) {
            Schema::create('galeri', function (Blueprint $table) {
                $table->id();
                $table->string('judul')->nullable();
                $table->string('gambar');
                $table->timestamps();
            });
        }
    }
};
