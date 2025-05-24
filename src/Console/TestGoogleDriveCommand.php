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
            $client = new \Google\Client();
            $client->setAuthConfig(config('database-backup.google_drive.credentials_path'));
            $client->addScope(\Google\Service\Drive::DRIVE);
            $service = new \Google\Service\Drive($client);

            // Try a simple API call: list files
            $files = $service->files->listFiles([
                'pageSize' => 5,
                'fields' => 'files(id, name)'
            ]);

            if (count($files->getFiles()) > 0) {
                $this->info("✅ Google Drive connection successful. Here are some files:");
                foreach ($files->getFiles() as $file) {
                    $this->line("- {$file->getName()} ({$file->getId()})");
                }
            } else {
                $this->warn("Connected, but no files found in the Google Drive.");
            }

        } catch (\Exception $e) {
            $this->error("❌ Error connecting to Google Drive: " . $e->getMessage());
        }
    }
}