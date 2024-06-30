# Laravel 10.x Application

This is a Laravel 10.x application running on PHP 8.1 with Nginx and MySQL on Ubuntu 22.04.

## Prerequisites

- Ubuntu 22.04
- PHP 8.1
- Composer
- Nginx
- MySQL
- Git

## Installation

1. Clone the repository
2. Install PHP dependencies:
3. Copy the example environment file:
4. Generate an application key:
5. Configure your `.env` file with your database credentials and other settings.
6. Run database migrations:
7. (Optional) Seed the database:
8. Copy
9. Configure Nginx:
   Create a new Nginx server block in `/etc/nginx/sites-available/` and create a symbolic link to it in `/etc/nginx/sites-enabled/`. A basic configuration might look like this:
    ```nginx
    server {
        listen 80;
        server_name your-domain.com;
        root /path/to/your/project/public;
    
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
            fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
            fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
            include fastcgi_params;
        }
    
        location ~ /\.(?!well-known).* {
            deny all;
        }
    }
    ```
   
10. `sudo systemctl restart nginx`
11. `sudo chown -R www-data:www-data /path/to/your/project
    sudo chmod -R 755 /path/to/your/project/storage`

