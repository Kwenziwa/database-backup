<?php

namespace DatabaseBackup\Services;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;

class GoogleDriveUploader
{
    protected Google_Service_Drive $driveService;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setAuthConfig(config('database-backup.google_drive.credentials_path'));
        $client->addScope(Google_Service_Drive::DRIVE_FILE);
        $client->setAccessType('offline');

        $this->driveService = new Google_Service_Drive($client);
    }

    public function upload(string $filePath, string $fileName = null, string $folderId = null): string
    {
        $fileMetadata = new Google_Service_Drive_DriveFile([
            'name' => $fileName ?? basename($filePath),
            'parents' => $folderId ? [$folderId] : [],
        ]);

        $content = file_get_contents($filePath);

        $uploadedFile = $this->driveService->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => 'application/zip',
            'uploadType' => 'multipart',
        ]);

        return $uploadedFile->id;
    }
}