<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Auto-migrasi & seeding tabel kategoris jika belum ada di database
        try {
            if (Schema::hasTable('katalogs') && !Schema::hasTable('kategoris')) {
                Artisan::call('migrate', ['--force' => true]);
                if (Schema::hasTable('kategoris') && \App\Models\Kategori::count() === 0) {
                    Artisan::call('db:seed', [
                        '--class' => 'Database\\Seeders\\InitialDataSeeder',
                        '--force' => true
                    ]);
                }
            }
        } catch (\Throwable $e) {
            // Silently continue if database is currently unreachable
        }
    }
}
