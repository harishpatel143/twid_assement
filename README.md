# Assessment

## Required `.env` Details

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=twid_test
    DB_USERNAME=root
    DB_PASSWORD=
    
    QUEUE_CONNECTION=database
    DB_ENGINE=InnoDB
## Steps to setups
    
Clone Repository

    git clone git@github.com:harishpatel143/twid_assement.git
    
    or 
    
    git clone https://github.com/harishpatel143/twid_assement.git
    
Create `.env` file from example
    
    cp .env.example .env

Setup Database connection and run migration
  
    php artisan migrate
    
Start queue (Need to run mandatory)
    
    php artisan queue:work
    
Serve Application in new terminal or create virtual host
    
    php -S localhost:8000 -t public


## There are two end point for fetch data from the URL
1. Using Mysql Job (Fastest but duplicate check is not implemented due to unique key issue)
2. Using Eloquent Job Batching (Slow, inserted 1000 record in every batch. Added check for duplicate records).
    Need to run `php artisan queue:work` for this option
 
#### Using sql Job Line : 
Call below endpoint with `POST` method from Postman

    http://localhost:8000/
    
#### Using Lumen Job Batching :
Call below endpoint with `POST` method from Postman
    
    http://localhost:8000/job-fetch
    
#### Listing in web browser

After processing, you will able to see listing in web browser using below url.

    http://localhost:8000/

## Issue related to mysql 
If you face any issue related security while fetch from command. Set you mysql ini config as below.

    secure_file_priv=""
    
Uncomment below line in `php.ini`

    allow_local_infile=on
    
    
## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
