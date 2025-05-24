<?php

namespace DatabaseBackup\Console;

use Illuminate\Console\Command;
use DatabaseBackup\Services\GoogleDriveUploader;

class TestGoogleDriveCommand extends Command
{
    protected $signature = 'google-drive:test';
    protected $description = 'Test connection to Google Drive and dump info';

    public function handle()
    {
        $this->info('Testing Google Drive connection...');

        try {
            $uploader = new GoogleDriveUploader();
            $this->info('✅ Google Drive connection successful.');

            $folderId = config('database-backup.folder_id');
            $this->info("Folder ID from config: $folderId");

            \Log::info('Google Drive Uploader instance:', [
                'uploader' => $uploader,
                'folder_id' => $folderId,
            ]);

            dd($uploader);

        } catch (\Exception $e) {
            \Log::error('Error connecting to Google Drive:', [
                'error' => $e->getMessage(),
            ]);
            $this->error('❌ Error connecting to Google Drive: ' . $e->getMessage());

        }
    }
}