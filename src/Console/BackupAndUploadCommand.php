<?php

namespace DatabaseBackup\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use DatabaseBackup\Services\GoogleDriveUploader;

class BackupAndUploadCommand extends Command
{
    protected $signature = 'google-drive:backup';
    protected $description = 'Backup the database and upload to Google Drive';

    public function handle()
    {
        // Get the backup disk from Spatie's config (default: 'local')
        $diskName = Config::get('backup.destination.disks')[0] ?? 'local';

        // Get the backup directory name (default: 'Laravel' from app name)
        $appName = Config::get('backup.backup.name', config('app.name', 'Laravel'));
        $backupDir = Storage::disk($diskName)->path($appName);

        $this->info("Cleaning up old backups in: $backupDir");
        if (File::exists($backupDir)) {
            File::deleteDirectory($backupDir);
            $this->info('Old backups deleted.');
        }

        File::makeDirectory($backupDir, 0755, true);

        $this->info('Running backup...');
        Artisan::call('backup:run', ['--only-db' => true]);
        $this->info('Backup complete.');

        $this->info("Listing all files in: $backupDir");
        foreach (File::allFiles($backupDir) as $file) {
            $this->info("Found file: {$file->getPathname()}");
        }

        $this->info('Locating the latest backup file...');
        $latestBackup = collect(File::allFiles($backupDir))
            ->filter(fn($file) => $file->getExtension() === 'zip')
            ->sortByDesc(fn($file) => $file->getMTime())
            ->first();

        if (!$latestBackup) {
            $this->error('No backup file found.');
            return;
        }

        $this->info("Latest backup: {$latestBackup->getFilename()}");

        $this->info('Uploading to Google Drive...');
        $uploader = new GoogleDriveUploader();
        $fileId = $uploader->upload(
            $latestBackup->getRealPath(),
            null,
            config('database-backup.folder_id')
        );

        $this->info("✅ Backup uploaded to Google Drive. File ID: $fileId");
    }
}