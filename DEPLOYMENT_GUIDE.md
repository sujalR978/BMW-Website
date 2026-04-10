# BMW Website - InfinityFree Deployment Guide

## Step 1: Create InfinityFree Account
1. Go to [infinityfree.com](https://www.infinityfree.com)
2. Sign up for a free account
3. Create a new hosting account from the dashboard

## Step 2: Create MySQL Database
1. Log in to your InfinityFree **Client Area**
2. Go to **Hosting Accounts** → Click your account
3. Open **Control Panel**
4. Find **MySQL Databases**
5. Create a new database — note down:
   - **Database Name** (e.g., `if0_12345678_bmw`)
   - **Username** (e.g., `if0_12345678`)
   - **Password** (the one you set)
   - **Hostname** (shown in the panel, e.g., `sql123.infinityfree.com`)

## Step 3: Import Database
1. In Control Panel, open **phpMyAdmin**
2. Select your database from the left sidebar
3. Click the **Import** tab
4. Click **Choose File** → select `bmw_clean.sql`
5. Click **Go** — wait for import to complete

## Step 4: Update Database Config
Open `php/database.php` and update the 4 values:
```php
$host = "sql123.infinityfree.com";       // Your InfinityFree SQL hostname
$username = "if0_12345678";              // Your database username
$password = "your_password_here";        // Your database password
$dbname = "if0_12345678_bmw";            // Your database name
```

## Step 5: Upload Files via FTP
1. Download **FileZilla** (free FTP client)
2. Use FTP credentials from InfinityFree Control Panel:
   - **Host**: Your FTP hostname (from control panel)
   - **Username**: Your FTP username
   - **Password**: Your FTP password
   - **Port**: 21
3. Connect and navigate to the `htdocs/` folder on the server
4. Upload **all project files** into `htdocs/`

### Important Upload Notes:
- Upload ALL files and folders (css, js, img, icon, cars, sound, video, uploads, dark-theme, php)
- Do NOT upload: `bmw.sql`, `bmw_clean.sql`, `DEPLOYMENT_GUIDE.md`
- Keep the same folder structure — do not reorganize

## Step 6: Test Your Website
1. Visit your InfinityFree subdomain (e.g., `yoursite.infinityfreeapp.com`)
2. Test these pages:
   - Home page (`index.php`)
   - Car models page
   - Registration page
   - Login page
   - Admin login (username: `sujal`, password: `123`)

## Troubleshooting

### "Connection failed" error
- Double-check all 4 database values in `php/database.php`
- Make sure the database was created successfully in Control Panel
- InfinityFree hostname is NOT `localhost`

### Pages show blank/errors
- Check PHP version compatibility (InfinityFree uses PHP 8.3)
- Make sure all files uploaded correctly via FTP

### Images not loading
- Check that `img/`, `icon/`, `cars/` folders were uploaded
- File names are case-sensitive on Linux servers

### 403 Forbidden
- Make sure files are in the `htdocs/` folder, not a subfolder
- Check that `.htaccess` is uploaded correctly

## File Size Limits
- Max file size: **10 MB** per file
- Max PHP/HTML file: **1 MB** per file
- All your files are within these limits ✅
