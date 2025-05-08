# I-fixit Deployment Documentation

## Current Production Setup

The I-fixit application is currently deployed on Hostinger with the following structure:

```
public_html/
├── index.php (modified to point to i-fixit directory)
├── .htaccess (from Laravel's public directory)
├── build/ (compiled assets)
│   └── manifest.json
├── i-fixit/ (main Laravel application)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   ├── .env (production environment file)
│   └── artisan
└── other public files...
```

## Deployment Process

### Manual Deployment

1. **Build Assets Locally**:
   ```bash
   npm install
   npm run build
   ```

2. **Upload Files to Hostinger**:
   - Upload the entire Laravel application to `public_html/i-fixit/`
   - Upload the contents of the `public` directory to `public_html/`
   - Upload the compiled assets from `public/build/` to `public_html/build/`

3. **Update index.php**:
   Ensure the `index.php` file in `public_html` has the correct paths:
   ```php
   require __DIR__.'/i-fixit/vendor/autoload.php';
   $app = require_once __DIR__.'/i-fixit/bootstrap/app.php';
   ```

   The full modified index.php should look like:
   ```php
   <?php

   use Illuminate\Contracts\Http\Kernel;
   use Illuminate\Http\Request;

   define('LARAVEL_START', microtime(true));

   if (file_exists($maintenance = __DIR__.'/i-fixit/storage/framework/maintenance.php')) {
       require $maintenance;
   }

   require __DIR__.'/i-fixit/vendor/autoload.php';

   $app = require_once __DIR__.'/i-fixit/bootstrap/app.php';

   $kernel = $app->make(Kernel::class);

   $response = $kernel->handle(
       $request = Request::capture()
   )->send();

   $kernel->terminate($request, $response);
   ```

4. **Configure Environment**:
   - Ensure the `.env` file in `public_html/i-fixit/` has the correct production settings
   - Set `APP_ENV=production`
   - Set `APP_DEBUG=false`
   - Set `APP_URL=https://i-fixit.chisolution.io`

5. **Run Migrations**:
   ```bash
   cd ~/domains/i-fixit.chisolution.io/public_html/i-fixit
   php artisan migrate
   ```

6. **Clear Caches**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   php artisan route:clear
   ```

### Automated Deployment

The project now includes a GitHub Actions workflow for automated deployments:

1. **The `.github/workflows/deploy.yml` file**:
   ```yaml
   name: Deploy to Production

   on:
     push:
       branches: [ main ]

   jobs:
     deploy:
       runs-on: ubuntu-latest
       steps:
         - name: Checkout code
           uses: actions/checkout@v3
           with:
             repository: delan75/I-fixit
             token: ${{ secrets.GITHUB_TOKEN }}

         - name: Setup PHP
           uses: shivammathur/setup-php@v2
           with:
             php-version: '8.2'
             extensions: mbstring, bcmath, pdo, pdo_mysql, exif, pcntl, gd

         - name: Install Composer Dependencies
           run: composer install --no-dev --optimize-autoloader

         - name: Setup Node.js
           uses: actions/setup-node@v3
           with:
             node-version: '18'

         - name: Install NPM Dependencies
           run: npm install

         - name: Build Assets
           run: npm run build

         - name: Create i-fixit Directory Structure
           run: |
             mkdir -p deploy/i-fixit
             mkdir -p deploy/build

         - name: Copy Laravel Application to i-fixit Directory
           run: |
             # Copy all Laravel application files except public directory to i-fixit
             rsync -av --exclude='public' --exclude='node_modules' --exclude='.git' --exclude='.github' --exclude='deploy' . deploy/i-fixit/

         - name: Copy Public Files
           run: |
             # Copy public directory contents to deploy root
             rsync -av public/ deploy/

         - name: Copy Build Assets
           run: |
             # Copy build assets to deploy/build
             if [ -d "public/build" ]; then
               rsync -av public/build/ deploy/build/
             fi

         - name: Update index.php
           run: |
             # Ensure index.php points to i-fixit directory
             sed -i "s|__DIR__.'/../|__DIR__.'/i-fixit/|g" deploy/index.php
             # Verify the change was made
             cat deploy/index.php

         - name: Ensure Storage Directory Permissions
           run: |
             chmod -R 775 deploy/i-fixit/storage

         - name: Deploy to Hosting
           uses: SamKirkland/FTP-Deploy-Action@v4.3.4
           with:
             server: ${{ secrets.FTP_SERVER }}
             username: ${{ secrets.FTP_USERNAME }}
             password: ${{ secrets.FTP_PASSWORD }}
             local-dir: ./deploy/
             server-dir: /public_html/
             exclude: |
               **/.git*
               **/.git*/**
               **/node_modules/**
               **/.env.example

         - name: Run Post-Deployment Commands
           uses: appleboy/ssh-action@master
           with:
             host: ${{ secrets.SSH_HOST }}
             username: ${{ secrets.SSH_USERNAME }}
             password: ${{ secrets.SSH_PASSWORD }}
             port: ${{ secrets.SSH_PORT }}
             script: |
               cd ~/public_html/i-fixit
               php artisan migrate --force
               php artisan config:clear
               php artisan cache:clear
               php artisan view:clear
               php artisan route:clear
               php artisan optimize
   ```

2. **Required GitHub Secrets**:
   - `FTP_SERVER`: Your hosting FTP server (usually your domain)
   - `FTP_USERNAME`: Your hosting FTP username
   - `FTP_PASSWORD`: Your hosting FTP password
   - `SSH_HOST`: Your hosting SSH host
   - `SSH_USERNAME`: Your hosting SSH username
   - `SSH_PASSWORD`: Your hosting SSH password
   - `SSH_PORT`: Your hosting SSH port (usually 65002)

3. **How It Works**:
   - The workflow maintains your local development structure
   - During deployment, it creates a temporary deployment structure that matches your hosting requirements
   - This allows you to keep your preferred local development structure while ensuring the production environment has the correct structure

## Git Workflow

To ensure your production setup remains intact, follow these Git workflow practices:

1. **Branch Strategy**:
   - `main`: Production-ready code that matches the live site
   - `develop`: Integration branch for feature development
   - `feature/*`: Individual feature branches

2. **Protected Branches**:
   - Configure `main` as a protected branch in GitHub
   - Require pull request reviews before merging to `main`
   - Require status checks to pass before merging to `main`

3. **Pre-Deployment Checklist**:
   - Build assets locally and test
   - Run all tests
   - Check for any environment-specific configurations
   - Verify database migrations

4. **Post-Deployment Verification**:
   - Verify the site loads correctly
   - Test critical functionality
   - Check for any errors in the logs

## Environment Configuration

### Production Environment (.env)

```
APP_NAME="I-fixit"
APP_ENV=production
APP_KEY=base64:your_app_key_here
APP_DEBUG=false
APP_URL=https://i-fixit.chisolution.io

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_hostinger_database
DB_USERNAME=your_hostinger_username
DB_PASSWORD=your_hostinger_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=your_mail_username
MAIL_PASSWORD=your_mail_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@i-fixit.chisolution.io"
MAIL_FROM_NAME="${APP_NAME}"
```

## Troubleshooting

### Common Issues

1. **403 Forbidden Error**:
   - Check file permissions (directories: 755, files: 644)
   - Verify .htaccess configuration
   - Ensure index.php is in the correct location

2. **500 Internal Server Error**:
   - Check PHP error logs
   - Verify .env configuration
   - Check storage directory permissions

3. **Missing Assets**:
   - Rebuild and re-upload assets
   - Check manifest.json file
   - Verify asset paths in blade templates

4. **Database Connection Issues**:
   - Verify database credentials in .env
   - Check database server status
   - Ensure database user has correct permissions

5. **Deployment Failures**:
   - **"Project directory is not a git repository"**: Ensure the GitHub Actions workflow is using the correct repository URL
   - **"Failed to connect to FTP server"**: Verify FTP credentials in GitHub Secrets
   - **"Permission denied"**: Check that the FTP user has write permissions to the target directory
   - **"File not found"**: Ensure all paths in the deployment script are correct
   - **"Index.php not found"**: Verify that the public directory contents are being copied correctly
   - **"Unexpected EOF while looking for matching"**: Check for syntax errors in shell commands, especially in sed commands with complex quotes and escape characters

### Recovery Procedures

1. **Rollback to Previous Version**:
   ```bash
   git checkout previous_working_commit
   # Then follow the deployment steps
   ```

2. **Database Rollback**:
   ```bash
   php artisan migrate:rollback
   ```

3. **Restore from Backup**:
   - Restore database from backup
   - Restore files from backup

## Backup Strategy

1. **Database Backups**:
   - Daily automated backups via Hostinger control panel
   - Manual backup before major updates:
     ```bash
     mysqldump -u username -p database_name > backup.sql
     ```

2. **File Backups**:
   - Weekly full site backup via Hostinger control panel
   - Manual backup before major updates

## Security Considerations

1. **SSL Certificate**:
   - Ensure SSL is enabled and certificate is valid
   - Force HTTPS via .htaccess

2. **File Permissions**:
   - Directories: 755
   - Files: 644
   - Storage and bootstrap/cache: 775

3. **Environment Variables**:
   - Keep .env file secure and out of public access
   - Use strong, unique passwords

4. **Regular Updates**:
   - Keep Laravel and all packages updated
   - Apply security patches promptly
