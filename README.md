# Assessment

## Steps to setups
    
Clone Repository

    git clone git@github.com:harishpatel143/twid_assement.git
    
    or 
    
    git clone https://github.com/harishpatel143/twid_assement.git
    
Create `.env` file from example
    
    cp .env.example .env

Setup Database connection and run migration
  
    php artisan migrate
    
Start queue
    
    php artisan queue:work
    
Serve Application in new terminal or create virtual host
    
    php -S localhost:8000 -t public
    
Call below endpoint with `POST` method from Postman

    http://localhost:8000/

After processing you will able to see listing in web browser using below url.

    http://localhost:8000/


## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
