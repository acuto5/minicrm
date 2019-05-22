#Mini-CRM

Project to manage companies and their employees.
##Requirements

###Tools

- composer
- Git

###Server

- `PHP` >= **7.1.3**
- `OpenSSL` PHP Extension
- `PDO` PHP Extension
- `Mbstring` PHP Extension
- `Tokenizer` PHP Extension
- `XML` PHP Extension
- `Ctype` PHP Extension
- `JSON` PHP Extension

##Instructions

###Installation

- Create `mysql database` and login credentials.
- Clone project:
```
$ git clone https://github.com/acuto5/minicrm.git
```
- Go to project directory.
- Create `.env` file from `.env.example` file.
- Add `FILESYSTEM_DRIVER=public` value into `.env` file for symbolic link.
- Add your `database credentials` to `.env` file.
- Add your `mailtrap credentials` to `.env` file.
- Install composer:
```
$ composer install
```
- Generate key for application:
```
$ php artisan key:generate
```
- Run database migrations:
```
$ php artisan migrate
```
- Seed database for administrator:
```
$ php artisan db:seed
```
- Create a symbolic link from "public/storage" to "storage/app/public":
```
$ php artisan storage:link
```
###DEV

- If you don't have virtual server, you can run `php artisan serve` command to create virtual server.

###Initial system login

- Email: `admin@admin.com`
- Password: `password`