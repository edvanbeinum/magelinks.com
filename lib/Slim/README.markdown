# Slim Framework for PHP 5

Thank you for choosing the Slim Framework, a micro-framework for PHP 5 inspired by [Sinatra](http://sinatrarb.com).

## Features

The Slim Framework for PHP 5 provides the following notable features out-of-the-box:

* Clean and simple DSL for writing powerful web applications
* RESTful HTTP routes (GET, POST, PUT, DELETE)
  * Named routes w/ `urlFor()` helper
  * Route passing
  * Route redirects
  * Route halting
  * Custom **Not Found** handler
  * Custom **Error** handler
  * Optional route segments... /archive(/:year(/:month(/:day)))
* Easy app configuration
* Easy templating with custom Views (ie. Twig, Smarty, Mustache, ...)
* Secure sessions
* Signed cookies with AES-256 encryption
* Flash messaging
* HTTP caching (ETag and Last-Modified)
* Logging
* Error and Exception handling
* Supports PHP 5+

## "Hello World" application (PHP 5 >= 5.3)

The Slim Framework for PHP 5 supports anonymous functions. This is the preferred method of defining Slim application routes.

    <?php
    require 'Slim/Slim.php';
    $app = new Slim();
    $app->get('/hello/:name', function ($name) {
        echo "Hello, $name!";
    });
    $app->run();
    ?>

## "Hello World" application (PHP 5 < 5.3)

If you are running PHP 5 < 5.3, the second `Slim::get` app instance method parameter will be the name of a callable function instead of an anonymous function.

    <?php
    require 'Slim/Slim.php';
    $app = new Slim();
    $app->get('/hello/:name', 'hello');
    function hello($name) {
        echo "Hello, $name!";
    }
    $app->run();
    ?>

## Get Started

### Install Slim

Download the Slim Framework for PHP 5 and unzip the downloaded file into your virtual host's public directory. Slim will work in a sub-directory, too.

### Setup .htaccess

Ensure the `.htaccess` and `index.php` files are in the same public-accessible directory. The `.htaccess` file should contain this code:

    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php [QSA,L]

### Build Your Application

Your Slim application will be defined in `index.php`. First, `require` the Slim Framework:

    require 'Slim/Slim.php';

Next, initialize the Slim application:

    $app = new Slim();

Next, define your application's routes:

    $app->get('/hello/:name', function ($name) {
        echo "Hello $name";
    });

Finally, run your Slim application:

    $app->run();

For more information about building an application with the Slim Framework, refer to the [official documentation](http://github.com/codeguy/Slim/wiki/Slim-Framework-Documentation).

## About the Author

Slim is created and maintained by Josh Lockhart, a web developer by day at [New Media Campaigns](http://www.newmediacampaigns.com), and a [hacker by night](http://github.com/codeguy).

Slim is in active development, and test coverage is continually improving.

## Links and Resources

For the most up-to-date information and news, follow the Slim PHP 5 micro framework on Twitter:

<http://www.twitter.com/slimphp>

Additional resources (ie. custom Views and plugins) are available online in a separate repository so this primary repository remains as light-weight as possible.

<https://github.com/codeguy/Slim-Extras>

Other helpful links:

* Road Map:       <http://github.com/codeguy/Slim/wiki/Road-Map>
* Documentation:  <http://github.com/codeguy/Slim/wiki/Slim-Framework-Documentation>
* Source Code:    <http://github.com/codeguy/Slim/>
* Twitter:        <http://www.twitter.com/slimphp>
* LinkedIn:       <http://www.linkedin.com/in/joshlockhart>
* Email:          [info@joshlockhart.com](info@joshlockhart.com)

## Open Source License

Slim is released under the MIT public license.

<http://www.slimframework.com/license>