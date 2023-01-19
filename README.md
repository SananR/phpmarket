
# PHPMarket

A simple backend API for an online marketplace system created with Laravel. 


## Installation

Please check the official Laravel Sail installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/9.x/installation#laravel-and-docker)

Clone the repository
```bash
git clone git@github.com:SananR/phpmarket.git
```
Switch to the repo folder and install all the dependencies using NPM and composer
```bash
cd phpmarket/phpmarket
npm install
composer install
```
Copy the example env file and make the required configuration changes in the .env file
```bash
cp .env.example .env
```
Generate a new application key and migrate database
```bash
php artisan key:generate
php artisan migrate:fresh
```
Start up using Laravel Sail
```bash
./vendor/bin/sail up
```
You can now access the server at http://localhost:8000
