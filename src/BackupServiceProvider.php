<?php

namespace DatabaseBackup;

use Illuminate\Support\ServiceProvider;

class BackupServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\BackupAndUploadCommand::class,
                Console\TestGoogleDriveCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../config/database-backup.php' => config_path('database-backup.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/database-backup.php',
            'database-backup'
        );
    }
}