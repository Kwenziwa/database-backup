# 📦 Database Backup

**Database Backup** is a Laravel package that automates database backups and uploads them to **Google Drive**.
It seamlessly integrates with [Spatie's Laravel Backup](https://github.com/spatie/laravel-backup) to handle database dumps and uses the official Google API Client to upload your backups.

---

## 🚀 Features

✅ Backup your database using Spatie's Laravel Backup  
✅ Automatically upload the latest backup to Google Drive  
✅ Clean and modern Laravel 12+ compatible  
✅ Easy installation and configuration

---

## 🔧 Installation

Install via Composer (for local development):

```bash
composer require kwenziwa/database-backup:@dev --with-all-dependencies
```

If using as a path repository:

1️⃣ Add to your Laravel app's `composer.json`:

```json
"repositories": [
    {
        "type": "path",
        "url": "packages/kwenziwa/database-backup"
    }
]
```

2️⃣ Then:

```bash
composer require kwenziwa/database-backup
```

---

## ⚙️ Configuration

1️⃣ Publish the config:

```bash
php artisan vendor:publish --tag=config
```

2️⃣ Set your **Google Drive Folder ID** in `.env`:

```bash
GOOGLE_DRIVE_FOLDER_ID=your-google-drive-folder-id
```

3️⃣ Ensure your **Google API credentials** are saved at:

```
storage/app/google-drive/credentials.json
```

---

## 📥 Usage

Run the backup and upload to Google Drive:

```bash
php artisan google-drive:backup
```

---

## 🌍 Requirements

- PHP 8.2+
- Laravel 10, 11, or 12
- Google API Credentials (OAuth2 JSON)
- Spatie Laravel Backup 9.x

---

## 🧱 Package Structure

```
/src
    /Console
        BackupAndUploadCommand.php
    /Services
        GoogleDriveUploader.php
    BackupServiceProvider.php
/config
    database-backup.php
composer.json
```

---

## 👤 Author

Developed by [Kwenziwa Khanyile](https://github.com/kwenziwa)  
Feel free to contribute or open issues for improvements!

---

## 📄 License

MIT © 2024 Kwenziwa Khanyile
