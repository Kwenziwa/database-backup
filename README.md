# 📦 kwenziwa/database-backup

A Laravel package to automate database backups and upload them to **Google Drive**.
Seamlessly integrates with [Spatie's Laravel Backup](https://github.com/spatie/laravel-backup) and the Google API client.
Ideal for keeping your backups safe and accessible in the cloud.

---

## 🚀 Features

- 🎯 Backup your database with Spatie’s Laravel Backup
- ☁️ Upload the latest backup automatically to Google Drive
- 🔒 Fully Laravel 12+ compatible
- 🔧 Easy configuration and installation

---

## 📥 Installation

Install the package via Composer:

```bash
composer require kwenziwa/database-backup
```

---

## ⚙️ Configuration

### Step 1: Publish Config

```bash
php artisan vendor:publish --tag=config
```

Creates `config/database-backup.php`.

### Step 2: Google API Credentials

1️⃣ Create a **Google Service Account** via the [Google Cloud Console](https://console.cloud.google.com/).  
   - Go to [Google Cloud Service Accounts](https://console.cloud.google.com/iam-admin/serviceaccounts)  
   - Click **Create Service Account**  
   - Follow the prompts, download the **JSON key file**.

2️⃣ Enable the **Google Drive API**:  
   - Go to [Google Drive API](https://console.cloud.google.com/apis/library/drive.googleapis.com)  
   - Click **Enable**.

3️⃣ Save the JSON key as:

```
storage/app/google-drive/credentials.json
```

4️⃣ Share your Google Drive folder with the email from the JSON key:

- Find the `client_email` in the JSON.
- Go to your Google Drive folder.
- Click **Share** → paste the `client_email`.
- Grant **Editor** access.

### Step 3: .env Settings

Add your Google Drive folder ID in `.env`:

```bash
GOOGLE_DRIVE_FOLDER_ID=your-google-drive-folder-id
GOOGLE_DRIVE_CREDENTIALS=storage/app/google-drive/credentials.json
```

---

## 🚀 Usage

Backup your database and upload to Google Drive:

```bash
php artisan google-drive:backup
```

Test Google Drive connection:

```bash
php artisan google-drive:test
```

---

## 🌍 Requirements

- PHP 8.2+
- Laravel 10, 11, or 12
- [Spatie Laravel Backup](https://github.com/spatie/laravel-backup) v9.2.8+
- [Google API Client](https://github.com/googleapis/google-api-php-client)

---

## 📖 Documentation

| Command                               | Description                                     |
| ------------------------------------ | ----------------------------------------------- |
| `php artisan google-drive:backup`    | Backup database and upload to Google Drive      |
| `php artisan google-drive:test`      | Test Google Drive connection and credentials    |
| `php artisan vendor:publish --tag=config` | Publish the package config file                 |

---

## 🙌 Author

Developed by [Kwenziwa Khanyile](https://github.com/kwenziwa)  
Feel free to contribute, submit issues, or fork the repository!

---

## 📄 License

MIT © 2024 Kwenziwa Khanyile
