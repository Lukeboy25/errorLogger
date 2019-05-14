# errorLogger

You can install the package through Composer.
  
    composer require lukeboy25/errorlogger 1.1.2.x-dev

*In case of Laravel 5.5, you still need to manually register this as the service provider has to be the first provider that needs to be registered.*

You must install this service provider and add this to your app.php:

    // config/app.php
    'providers' => [
        // Add this to your other providers
        ErrorLogger\ErrorLoggerServiceProvider::class,

        //...
        //...
    ];

Then publish the config and migration file of the package using artisan.

    php artisan vendor:publish --provider="ErrorLogger\ErrorLoggerServiceProvider"
      
And adjust config file (config/errorlogger.php) with your desired settings.

Add to your Exception Handler's (/app/Exceptions/Handler.php by default) report method these line and add the use line:

    public function report(Exception $e)
    {
        if ($this->shouldReport($exception) && class_exists(\ErrorLogger\ErrorLogger::class)) {
            app('errorlogger')->handle($exception);
        }

        return parent::report($e);
    }
