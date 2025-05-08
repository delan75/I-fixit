# I-fixit Deployment Documentation

## Current Production Setup

The I-fixit application is currently deployed on Hostinger with the following structure:

```
public_html/
├── index.php (from Laravel's public directory)
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

### Automated Deployment (Future Implementation)

For future automated deployments, consider setting up a GitHub Actions workflow:

1. **Create a `.github/workflows/deploy.yml` file**:
   ```yaml
   name: Deploy to Hostinger

   on:
     push:
       branches: [ main ]

   jobs:
     build:
       runs-on: ubuntu-latest
       steps:
         - uses: actions/checkout@v3
         
         - name: Setup PHP
           uses: shivammathur/setup-php@v2
           with:
             php-version: '8.2'
             
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
           
         - name: Deploy to Hostinger
           uses: SamKirkland/FTP-Deploy-Action@v4.3.4
           with:
             server: ${{ secrets.FTP_SERVER }}
             username: ${{ secrets.FTP_USERNAME }}
             password: ${{ secrets.FTP_PASSWORD }}
             local-dir: ./
             server-dir: /domains/i-fixit.chisolution.io/public_html/i-fixit/
             exclude: |
               node_modules/**
               public/**
               
         - name: Deploy Public Files
           uses: SamKirkland/FTP-Deploy-Action@v4.3.4
           with:
             server: ${{ secrets.FTP_SERVER }}
             username: ${{ secrets.FTP_USERNAME }}
             password: ${{ secrets.FTP_PASSWORD }}
             local-dir: ./public/
             server-dir: /domains/i-fixit.chisolution.io/public_html/
             
         - name: Run Migrations and Clear Cache
           uses: appleboy/ssh-action@master
           with:
             host: ${{ secrets.SSH_HOST }}
             username: ${{ secrets.SSH_USERNAME }}
             password: ${{ secrets.SSH_PASSWORD }}
             port: ${{ secrets.SSH_PORT }}
             script: |
               cd ~/domains/i-fixit.chisolution.io/public_html/i-fixit
               php artisan migrate --force
               php artisan config:cache
               php artisan route:cache
               php artisan view:cache
               php artisan optimize
   ```

2. **Add GitHub Secrets**:
   - `FTP_SERVER`: Your Hostinger FTP server (usually your domain)
   - `FTP_USERNAME`: Your Hostinger FTP username
   - `FTP_PASSWORD`: Your Hostinger FTP password
   - `SSH_HOST`: Your Hostinger SSH host (92.113.19.65)
   - `SSH_USERNAME`: Your Hostinger SSH username (u382128891)
   - `SSH_PASSWORD`: Your Hostinger SSH password
   - `SSH_PORT`: Your Hostinger SSH port (65002)

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
