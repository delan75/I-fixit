# I-fixit Administrator Guide

## Introduction

This guide provides comprehensive information for system administrators of the I-fixit car investment tracking system. It covers installation, configuration, user management, system maintenance, and troubleshooting.

## Table of Contents

1. [System Requirements](#system-requirements)
2. [Installation](#installation)
3. [Configuration](#configuration)
4. [User Management](#user-management)
5. [System Maintenance](#system-maintenance)
6. [Backup and Recovery](#backup-and-recovery)
7. [Security](#security)
8. [Troubleshooting](#troubleshooting)
9. [API Integration](#api-integration)

## System Requirements

### Server Requirements
- PHP 8.2 or higher
- MySQL 8.0 or higher
- Composer
- Node.js and NPM (for frontend assets)
- Web server (Apache or Nginx)
- SSL certificate

### Recommended Server Specifications
- CPU: 2+ cores
- RAM: 4GB minimum
- Storage: 20GB minimum (more for image storage)
- Bandwidth: Depends on user count, minimum 10Mbps

## Installation

### Fresh Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-organization/i-fixit.git
   cd i-fixit
   ```

2. Install PHP dependencies:
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

3. Install frontend dependencies:
   ```bash
   npm install
   npm run build
   ```

4. Create environment file:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Configure database connection in `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ifixit
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. Run migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```

7. Create symbolic link for storage:
   ```bash
   php artisan storage:link
   ```

8. Set proper permissions:
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

### Updating the Application

1. Pull the latest changes:
   ```bash
   git pull origin main
   ```

2. Install dependencies:
   ```bash
   composer install --optimize-autoloader --no-dev
   npm install
   npm run build
   ```

3. Run migrations:
   ```bash
   php artisan migrate
   ```

4. Clear caches:
   ```bash
   php artisan optimize:clear
   ```

## Configuration

### Environment Configuration

Key settings in the `.env` file:

```
APP_NAME=I-fixit
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ifixit
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.your-mail-provider.com
MAIL_PORT=587
MAIL_USERNAME=your_email@example.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@your-domain.com
MAIL_FROM_NAME="${APP_NAME}"

PUSHER_APP_ID=your_pusher_app_id
PUSHER_APP_KEY=your_pusher_app_key
PUSHER_APP_SECRET=your_pusher_app_secret
PUSHER_APP_CLUSTER=your_pusher_cluster
```

### Web Server Configuration

#### Apache

Example virtual host configuration:

```apache
<VirtualHost *:80>
    ServerName your-domain.com
    ServerAlias www.your-domain.com
    DocumentRoot /var/www/i-fixit/public
    
    <Directory /var/www/i-fixit/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/i-fixit-error.log
    CustomLog ${APACHE_LOG_DIR}/i-fixit-access.log combined
    
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</VirtualHost>

<VirtualHost *:443>
    ServerName your-domain.com
    ServerAlias www.your-domain.com
    DocumentRoot /var/www/i-fixit/public
    
    <Directory /var/www/i-fixit/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/i-fixit-error.log
    CustomLog ${APACHE_LOG_DIR}/i-fixit-access.log combined
    
    SSLEngine on
    SSLCertificateFile /path/to/your/certificate.crt
    SSLCertificateKeyFile /path/to/your/private.key
    SSLCertificateChainFile /path/to/your/chain.crt
</VirtualHost>
```

#### Nginx

Example configuration:

```nginx
server {
    listen 80;
    server_name your-domain.com www.your-domain.com;
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl;
    server_name your-domain.com www.your-domain.com;
    
    ssl_certificate /path/to/your/certificate.crt;
    ssl_certificate_key /path/to/your/private.key;
    
    root /var/www/i-fixit/public;
    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    
    index index.php;
    
    charset utf-8;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    
    error_page 404 /index.php;
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Scheduled Tasks

Add the following cron job to run Laravel's scheduler:

```
* * * * * cd /path/to/i-fixit && php artisan schedule:run >> /dev/null 2>&1
```

## User Management

### Creating a Superuser

To create a superuser with elevated permissions:

```bash
php artisan db:seed --class=SuperuserSeeder
```

This will create a superuser with the following credentials:
- Email: superuser@example.com
- Password: password

Change these credentials immediately after first login.

### Managing Users

1. Log in as an admin or superuser
2. Navigate to User Management
3. From here you can:
   - Create new users
   - Edit existing users
   - Change user roles
   - Activate/deactivate users
   - Reset passwords

### User Roles

- **Superuser**: Complete access to all system features, including activity logs
- **Admin**: Access to all car management features and user management
- **Manager**: Can manage cars, costs, and view reports
- **Dealership**: Focus on dealership phase and sales
- **Repair**: Focus on repair phase and cost tracking
- **Supplier**: Limited access to parts management
- **Viewer**: Read-only access to cars and reports

## System Maintenance

### Cache Management

Clear application caches:

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

Rebuild caches for production:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Database Maintenance

Run database migrations:

```bash
php artisan migrate
```

Reset and reseed the database (caution: this will delete all data):

```bash
php artisan migrate:fresh --seed
```

### Log Management

View application logs:

```bash
tail -f storage/logs/laravel.log
```

Configure log rotation in `config/logging.php`.

## Backup and Recovery

### Backup Strategy

1. **Database Backup**:
   ```bash
   mysqldump -u username -p ifixit > ifixit_backup_$(date +%Y%m%d).sql
   ```

2. **File Backup**:
   ```bash
   tar -czf ifixit_files_$(date +%Y%m%d).tar.gz /path/to/i-fixit
   ```

3. **Automated Backup Script**:
   Create a shell script with the above commands and schedule it with cron.

### Recovery Procedure

1. **Database Restoration**:
   ```bash
   mysql -u username -p ifixit < ifixit_backup_20240101.sql
   ```

2. **File Restoration**:
   ```bash
   tar -xzf ifixit_files_20240101.tar.gz -C /path/to/restore
   ```

## Security

### Best Practices

1. **Keep Software Updated**:
   - Regularly update Laravel and dependencies
   - Apply security patches promptly

2. **Secure Configuration**:
   - Set `APP_DEBUG=false` in production
   - Use HTTPS only
   - Implement proper file permissions

3. **Authentication Security**:
   - Enforce strong password policies
   - Enable two-factor authentication
   - Implement login throttling

4. **Regular Security Audits**:
   - Review user access regularly
   - Check for suspicious activity in logs
   - Conduct periodic security assessments

### SSL Configuration

Ensure your SSL certificate is properly configured and renewed before expiration.

## Troubleshooting

### Common Issues

#### Application Error 500
- Check Laravel logs at `storage/logs/laravel.log`
- Verify file permissions
- Ensure `.env` file exists and is properly configured

#### Database Connection Issues
- Verify database credentials in `.env`
- Check if MySQL service is running
- Ensure database user has proper permissions

#### File Upload Problems
- Check PHP upload limits in `php.ini`
- Verify storage directory permissions
- Ensure symbolic link is created

### Debugging

Enable debugging temporarily:

1. Set `APP_DEBUG=true` in `.env`
2. Check detailed error messages
3. Remember to set `APP_DEBUG=false` when done

## API Integration

### Python Django API

The I-fixit system integrates with a Python Django API for advanced features:

1. **Configuration**:
   - Set API endpoint in `.env`:
     ```
     API_URL=https://api.your-domain.com
     API_KEY=your_api_key
     ```

2. **Authentication**:
   - The API uses JWT authentication
   - Tokens are automatically managed by the application

3. **Features**:
   - Web scraping for auction opportunities
   - Machine learning for price prediction
   - Market analysis and recommendations

4. **Monitoring**:
   - API health can be checked in the admin dashboard
   - Failed API calls are logged in `storage/logs/api.log`
