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

---

## 🔑 Google API Setup

### 1️⃣ Create Google API Credentials

- Go to the [Google Cloud Console](https://console.cloud.google.com/).
- Navigate to [Service Accounts](https://console.cloud.google.com/iam-admin/serviceaccounts).
- Click **Create Service Account**.
- Follow the prompts:
  - Name: e.g., `Database Backup Service`
  - Role: Choose **Editor** (or more restricted if desired).
- After creating the service account:
  - Go to the **Keys** tab.
  - Click **Add Key → Create New Key → JSON**.
  - Download the JSON key file.

### 2️⃣ Enable Google Drive API

- Visit the [Google Drive API page](https://console.cloud.google.com/apis/library/drive.googleapis.com) and click **Enable**.
- For detailed step-by-step instructions, see this guide:  
  [How to Enable Google Drive API on the Google Console](https://www.cybrosys.com/blog/how-to-enable-google-drive-api-on-the-google-console)

### 3️⃣ Save the Credentials File

Move the downloaded JSON key file to:

```
storage/app/google-drive/credentials.json
```

Ensure the path matches this in your `.env`:

```bash
GOOGLE_DRIVE_CREDENTIALS=storage/app/google-drive/credentials.json
```

---

## 📁 Set Up Google Drive Access

### 4️⃣ Get Your Google Drive Folder ID

- Create a folder in Google Drive (e.g., `Database Backups`).
- Right-click the folder → **Get Link** → Copy the long ID in the URL:
  
  Example:  
  ```
  https://drive.google.com/drive/folders/1a2B3cD4EfG5hI6Jk7LmNOPQr8TuvWXy
  ```
  The **folder ID** is:
  ```
  1a2B3cD4EfG5hI6Jk7LmNOPQr8TuvWXy
  ```

Add this to your `.env`:

```bash
GOOGLE_DRIVE_FOLDER_ID=1a2B3cD4EfG5hI6Jk7LmNOPQr8TuvWXy
```

---

### 5️⃣ Share Folder with Service Account

- Open your Google Drive folder.
- Click **Share**.
- In the **People** field, paste the `client_email` from your JSON file (example below).
- Give **Editor** access.

---

### 🔍 Example `credentials.json` Structure

```json
{
  "type": "service_account",
  "project_id": "your-project-id",
  "private_key_id": "your-private-key-id",
  "private_key": "-----BEGIN PRIVATE KEY-----\nABC...\n-----END PRIVATE KEY-----\n",
  "client_email": "database-backup@your-project.iam.gserviceaccount.com",
  "client_id": "1234567890",
  "auth_uri": "https://accounts.google.com/o/oauth2/auth",
  "token_uri": "https://oauth2.googleapis.com/token",
  "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
  "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/database-backup%40your-project.iam.gserviceaccount.com"
}
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
