# Notifier

## Setup

### Prerequisites
1. Php
2. Mysql
3. Apache/Nginx
4. [Composer](https://getcomposer.org/download/)

### Setting up application

Clone the repository
```console
git clone https://github.com/nitishkrojha/notifier.git
cd notifier
```

Create .env file
```console
cp .env.example .env
```

Install composer dependencies
```console
composer install
```

Generate api key for application
```console
php artisan key:generate
```

Run migrations
```console
<!-- Note: Please ensure having a database created for the application, and put same value in .env file. -->
php artisan migrate

```

Run php server
```console
php artisan serve
```
