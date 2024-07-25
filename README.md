
Step up instruction
.............................
1. create database
2. create .env file and copy the data env.example file

Run the following command 
-------------------------
composer update
php artisan migrate
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=RandStringSeeder
 php artisan key:generate
php artisan serve


user login details
.......................
user name: sanooptest@gmai.com
password: sa123#

