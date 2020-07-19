
##### Built Using
 PHP
  Laravel
   @laravel Framework,
     
       
### All Needed Files and 


for collection of post man to test APIs
**_[here](https://www.postman.com/collections/4c12a00dc63e494f5056?fbclid=IwAR36M9DOwYtc_rknRu8ZsUTcrv7P9bZKKEByu06bfsbgNqw2NqS7Lkr2C0A)_**



### Hardware Requirements
-	PHP > 7.2
-   Composer
-	Laravel 6.2

### Installation
first
```
$ git clone https://github.com/mohamedebrahim2020/blogAPI.git
```
```
$ cd final_project
```

1. rename .env.example file to .env 
then edit in .env file with
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
2. Install composer dependencies
```
$ composer install
```

3. Generate APP_KEY
```
$ php artisan key:generate
```
4.Run migrations
```
$ php artisan migrate
```
5.Run passport install
```
$ php artisan passport:install
```
5.Run file storage 
```
$ php artisan storage:link
```
6. Run server
```
$ php artisan serve
```

