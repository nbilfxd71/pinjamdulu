# 🚀 Pinjamdulu - Deployment Checklist

Complete checklist untuk deploy Pinjamdulu ke production server.

---

## Pre-Deployment (Local)

### Code Review
- [ ] All tests passing
- [ ] No console errors in browser DevTools
- [ ] No database errors in logs
- [ ] All features tested manually
- [ ] Code commented where necessary
- [ ] Environment variables properly configured

### Optimization
- [ ] Run `php artisan optimize`
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Check storage/logs for errors
- [ ] Verify all migrations clean

### Security Review
- [ ] Change default admin password
- [ ] Verify CSRF protection enabled
- [ ] Check password hashing (Bcrypt)
- [ ] Review authorization in all routes
- [ ] Check sensitive data not logged
- [ ] Verify no hardcoded secrets

---

## Environment Setup

### .env Configuration
```
# Application
APP_NAME=Pinjamdulu
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
APP_KEY=base64:xxxxxxxxxxxxx

# Database (Change from SQLite to MySQL)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pinjamdulu_prod
DB_USERNAME=pinjamdulu_user
DB_PASSWORD=StrongPassword123!

# Mail (if needed)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@email.com
MAIL_PASSWORD=your_app_password
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="Pinjamdulu"

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Cache
CACHE_DRIVER=redis
# or file if no redis
```

### Generate APP_KEY (if not exists)
```bash
php artisan key:generate
```

---

## Server Setup

### Linux/Ubuntu Server

#### 1. Install Dependencies
```bash
# Update system
sudo apt-get update && sudo apt-get upgrade -y

# Install PHP 8.1+
sudo apt-get install php8.1 php8.1-fpm php8.1-mysql php8.1-mbstring \
  php8.1-xml php8.1-curl php8.1-bcmath php8.1-zip -y

# Install MySQL
sudo apt-get install mysql-server -y

# Install Nginx
sudo apt-get install nginx -y

# Install Composer
curl -sS https://getcomposer.org/installer | sudo php -- \
  --install-dir=/usr/local/bin --filename=composer
```

#### 2. Create Database User
```bash
mysql -u root -p
CREATE DATABASE pinjamdulu_prod;
CREATE USER 'pinjamdulu_user'@'localhost' IDENTIFIED BY 'StrongPassword123!';
GRANT ALL PRIVILEGES ON pinjamdulu_prod.* TO 'pinjamdulu_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### 3. Clone & Setup Project
```bash
# Navigate to web root
cd /var/www/

# Clone project
git clone <repository-url> pinjamdulu
cd pinjamdulu

# Install dependencies
composer install --optimize-autoloader --no-dev

# Copy environment file
cp .env.example .env

# Edit .env with production values
sudo nano .env

# Generate key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed database (if needed)
php artisan db:seed

# Optimize
php artisan optimize
```

#### 4. Set Permissions
```bash
# Set ownership
sudo chown -R www-data:www-data /var/www/pinjamdulu

# Set directory permissions
sudo find /var/www/pinjamdulu -type d -exec chmod 755 {} \;
sudo find /var/www/pinjamdulu -type f -exec chmod 644 {} \;

# Set writable directories
sudo chmod -R 775 /var/www/pinjamdulu/storage
sudo chmod -R 775 /var/www/pinjamdulu/bootstrap/cache
```

#### 5. Configure Nginx
```bash
# Create config file
sudo nano /etc/nginx/sites-available/pinjamdulu
```

**Nginx Configuration**:
```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;

    # Redirect HTTP to HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name yourdomain.com www.yourdomain.com;

    # SSL Certificates (Let's Encrypt recommended)
    ssl_certificate /etc/letsencrypt/live/yourdomain.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/yourdomain.com/privkey.pem;

    root /var/www/pinjamdulu/public;
    index index.php;

    # Logging
    access_log /var/log/nginx/pinjamdulu_access.log;
    error_log /var/log/nginx/pinjamdulu_error.log;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Deny access to sensitive files
    location ~ /\. {
        deny all;
    }

    location ~ /^\.well-known {
        allow all;
    }

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;
}
```

Enable the site:
```bash
sudo ln -s /etc/nginx/sites-available/pinjamdulu /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

#### 6. Setup SSL with Let's Encrypt
```bash
sudo apt-get install certbot python3-certbot-nginx -y
sudo certbot certonly --nginx -d yourdomain.com -d www.yourdomain.com

# Auto-renew SSL
sudo systemctl enable certbot.timer
sudo systemctl start certbot.timer
```

#### 7. Setup PHP-FPM
```bash
# Edit PHP config
sudo nano /etc/php/8.1/fpm/php.ini

# Set upload_max_filesize and post_max_size
upload_max_filesize = 50M
post_max_size = 50M

# Restart PHP-FPM
sudo systemctl restart php8.1-fpm
```

#### 8. Setup Firewall
```bash
sudo ufw enable
sudo ufw allow 22/tcp      # SSH
sudo ufw allow 80/tcp      # HTTP
sudo ufw allow 443/tcp     # HTTPS
sudo ufw status
```

---

## Post-Deployment Testing

### 1. Verify Installation
```bash
cd /var/www/pinjamdulu

# Check migrations
php artisan migrate:status

# Check routes
php artisan route:list | grep -E "admin|petugas|peminjam"

# Check cache
php artisan config:show | grep APP_ENV
```

### 2. Test Application

#### Admin Access
- [ ] Navigate to https://yourdomain.com
- [ ] Login as admin@pinjamdulu.com
- [ ] Verify dashboard loads
- [ ] Test user creation
- [ ] Test alat creation
- [ ] Test peminjaman approval

#### Petugas Access
- [ ] Login as petugas1@pinjamdulu.com
- [ ] Verify dashboard loads
- [ ] Test approval workflow
- [ ] Test pengembalian recording
- [ ] Test laporan generation

#### Peminjam Access
- [ ] Login as peminjam1@pinjamdulu.com
- [ ] View alats list
- [ ] Test ajukan peminjaman
- [ ] Check peminjaman status

### 3. Database Verification
```bash
mysql -u pinjamdulu_user -p pinjamdulu_prod

# Check tables
SHOW TABLES;

# Check sample data
SELECT COUNT(*) FROM users;
SELECT COUNT(*) FROM alats;
SELECT COUNT(*) FROM peminjamans;

EXIT;
```

### 4. File Permissions Check
```bash
# Verify writable directories
ls -la /var/www/pinjamdulu/storage/
ls -la /var/www/pinjamdulu/bootstrap/cache/

# Both should show d-rwx for www-data
```

---

## Monitoring & Maintenance

### Daily Tasks
```bash
# Check error logs
tail -f /var/log/nginx/pinjamdulu_error.log

# Check Laravel logs
tail -f /var/www/pinjamdulu/storage/logs/laravel.log

# Monitor disk space
df -h

# Monitor memory
free -h
```

### Weekly Tasks
- [ ] Review error logs
- [ ] Check database size
- [ ] Verify backups running
- [ ] Check SSL certificate validity

### Monthly Tasks
- [ ] Update system packages
- [ ] Update Laravel/dependencies (with tests)
- [ ] Review security logs
- [ ] Optimize database indexes

### Setup Backups
```bash
# Create backup script
sudo nano /usr/local/bin/backup-pinjamdulu.sh
```

**Backup Script**:
```bash
#!/bin/bash

BACKUP_DIR="/backups/pinjamdulu"
DATE=$(date +%Y%m%d_%H%M%S)
DB_USER="pinjamdulu_user"
DB_PASS="StrongPassword123!"
DB_NAME="pinjamdulu_prod"
PROJECT_DIR="/var/www/pinjamdulu"

# Create backup directory
mkdir -p $BACKUP_DIR

# Backup database
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME | \
  gzip > $BACKUP_DIR/db_backup_$DATE.sql.gz

# Backup application
tar -czf $BACKUP_DIR/app_backup_$DATE.tar.gz $PROJECT_DIR

# Keep only last 30 days
find $BACKUP_DIR -name "*.gz" -mtime +30 -delete

echo "Backup completed: $DATE"
```

Make executable and setup cron:
```bash
sudo chmod +x /usr/local/bin/backup-pinjamdulu.sh

# Add to crontab (daily at 2 AM)
sudo crontab -e
# 0 2 * * * /usr/local/bin/backup-pinjamdulu.sh
```

---

## Cron Jobs (if needed)

```bash
# Edit crontab
php artisan schedule:run
```

Add to crontab:
```
* * * * * cd /var/www/pinjamdulu && php artisan schedule:run >> /dev/null 2>&1
```

---

## Performance Optimization

### 1. Database Optimization
```bash
php artisan tinker

# Create indexes
DB::statement('CREATE INDEX idx_peminjamans_user_id ON peminjamans(user_id)');
DB::statement('CREATE INDEX idx_peminjamans_alat_id ON peminjamans(alat_id)');
DB::statement('CREATE INDEX idx_alats_kategori_id ON alats(kategori_id)');
```

### 2. Redis Caching (Optional)
```bash
# Install Redis
sudo apt-get install redis-server -y

# Update .env
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 3. Enable Compression
In nginx config:
```nginx
gzip on;
gzip_types text/plain text/css text/xml text/javascript 
           application/x-javascript application/json;
gzip_min_length 1000;
```

---

## Security Hardening

### 1. Web Server Hardening
```nginx
# Hide server version
server_tokens off;

# Additional security headers
add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
add_header Content-Security-Policy "default-src 'self'" always;
```

### 2. PHP Hardening
```ini
; In /etc/php/8.1/fpm/php.ini
expose_php = Off
display_errors = Off
log_errors = On
error_log = /var/log/php-errors.log
```

### 3. MySQL Hardening
```bash
# Secure MySQL installation
sudo mysql_secure_installation
```

### 4. SSH Key Authentication
```bash
# Use SSH keys instead of passwords
ssh-keygen -t rsa -b 4096

# Disable password auth
sudo nano /etc/ssh/sshd_config
# PasswordAuthentication no
```

---

## Monitoring Tools

### Option 1: Systemctl Service
Create service file:
```bash
sudo nano /etc/systemd/system/pinjamdulu.service
```

```ini
[Unit]
Description=Pinjamdulu PHP Application
After=network.target

[Service]
Type=notify
ExecStart=/usr/local/bin/my_app_starter_script
Restart=on-failure
RestartSec=5s
User=www-data
Group=www-data

[Install]
WantedBy=multi-user.target
```

### Option 2: Supervisor (Process Management)
```bash
sudo apt-get install supervisor -y

# Create config
sudo nano /etc/supervisor/conf.d/pinjamdulu.conf
```

---

## Troubleshooting Deployment

### 502 Bad Gateway
```bash
# Check PHP-FPM
sudo systemctl status php8.1-fpm

# Restart PHP-FPM
sudo systemctl restart php8.1-fpm

# Check logs
sudo tail -f /var/log/php8.1-fpm.log
```

### 403 Forbidden
```bash
# Check permissions
sudo chown -R www-data:www-data /var/www/pinjamdulu
sudo chmod -R 755 /var/www/pinjamdulu
```

### Database Connection Error
```bash
# Test connection
mysql -h 127.0.0.1 -u pinjamdulu_user -p pinjamdulu_prod

# Check .env
cat /var/www/pinjamdulu/.env | grep DB_
```

### SSL Certificate Error
```bash
# Check certificate
sudo certbot renew --dry-run

# Force renewal
sudo certbot renew --force-renewal
```

---

## Scaling Considerations

For high traffic:
1. Use MySQL instead of SQLite
2. Setup Redis for caching
3. Consider load balancing
4. Use CDN for static assets
5. Optimize database queries
6. Setup message queue (optional)

---

## Post-Launch Maintenance

- [ ] Setup monitoring (New Relic, DataDog)
- [ ] Setup uptime monitoring (UptimeRobot)
- [ ] Setup error tracking (Sentry)
- [ ] Configure email notifications
- [ ] Setup daily backups
- [ ] Document deployment procedure
- [ ] Train team on deployment process

---

## Rollback Procedure

If issues occur:

```bash
# Stop application
sudo systemctl stop php8.1-fpm
sudo systemctl stop nginx

# Restore database backup
mysql -u root -p pinjamdulu_prod < /backups/db_backup_YYYYMMDD.sql

# Restore files
cd /var/www
tar -xzf /backups/app_backup_YYYYMMDD.tar.gz

# Restart services
sudo systemctl start php8.1-fpm
sudo systemctl start nginx

# Verify
curl https://yourdomain.com
```

---

## Support & Documentation

- **Laravel Docs**: https://laravel.com/docs
- **Nginx Docs**: https://nginx.org/en/docs/
- **MySQL Docs**: https://dev.mysql.com/doc/
- **Certbot Docs**: https://certbot.eff.org/docs/

---

## Deployment Log Template

Use this to track your deployment:

```
Date: ___________
Deployer: ___________
Environment: Production
Server IP: ___________

Pre-Deployment Checks:
- [ ] Code reviewed
- [ ] Tests passing
- [ ] Migrations ready

Deployment Steps:
- [ ] Pulled latest code
- [ ] Installed dependencies
- [ ] Configured .env
- [ ] Ran migrations
- [ ] Seeded data
- [ ] Set permissions

Post-Deployment Verification:
- [ ] Admin login works
- [ ] Petugas login works
- [ ] Peminjam login works
- [ ] Database connection OK
- [ ] File permissions OK
- [ ] SSL certificate OK

Status: ✅ LIVE
Notes: ___________
```

---

**Status**: ✅ Ready for Deployment  
**Last Updated**: February 2025
