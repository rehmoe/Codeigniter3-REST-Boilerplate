 # CodeIgniter REST API Boilerplate
This is a boilerplate for REST APIs using Codeigniter 3. I built this as a 
small scaffold for my API based projects and tried making it as 
un-opinionated as possible. It contains a number of cool features for REST 
APIs such as a built-in JWT library, static routes files brought to us by 
`Luthier-CI`, proper REST Controller library brought to us by Phil Sturgeon
 and Chris Kacerguis, a small but useful `MY_Controller` and an amazing 
 `MY_Model` brought to us by Avenir. Also included is a cool assortment of
  composer dependencies and integration for libraries like `Monolog` PSR3 
  Logger library, Dotenv by Vance Lucas for Environment configuration and 
  Whoops Errors for Cool Kids for API/UI errors during development. Also 
  included are a series of helper files, hooks and migrations to make the 
  instantiation of REST APIs far quicker and far more simple.

I built this to eliminate the need to constantly adjust the Codeigniter 
folder structure and move the application directory outside of the publicly
 accessible scope and to eliminate the need to repeat tasks like the need 
 to constantly configure a composer.json file for dependencies or load 
 helper files, separate the config into an environment based structure, 
 initiate the REST Controller library, add a `MY_Model` file, etc. This 
 boilerplate is geared towards building only APIs and not initially built 
 for User Interface mechanics.

I hope everyone enjoys this and finds it useful. Please feel free to offer
 any advice or issue PRs and fixes where you see fit. All credit for the 
 Codeigniter framework goes to the Codeigniter team at BCIT and credit for
  the composer dependencies goes to their respective authors. Without their
   work, this would've been a lot more difficult of an approach =)

# README:

## Folder Structure

```
ROOT/
├── application/        # APPPATH directory
├── application/vendor/ # VENDORPATH directory
    └── codeigniter/    # Codeigniter Framework
        └── framework/
            └── system/
├── application/composer.json
|
├── public_html/        # FCPATH directory
│   ├── .htaccess       # Prebuilt .htaccess
│   ├── .env.example    # Prebuilt .env file
│   ├── index.php       # Custom index.php file
└── 
```

## Useful Links

* [Composer Installation](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
* [CodeIgniter Framework](https://github.com/bcit-ci/CodeIgniter)
* [CodeIgniter Translations](https://github.com/bcit-ci/codeigniter3-translations)
* [RESTful API.net](https://restfulapi.net/)
* [REST API Tutorial.com](https://www.restapitutorial.com/)

## Requirements
 - [PHP >=7.2.0](http://www.php.net/manual/en/)
 - [Composer](http://getcomposer.org)
 
## Dependencies
 - [CodeIgniter 3.1.10 Framework](https://codeigniter.com)
 - [CodeIgniter REST Server](https://github.com/chriskacerguis/codeigniter-restserver)
 - [Whoops Error Handler](https://github.com/filp/whoops)
 - [Standard Exceptions](https://github.com/crazycodr/standard-exceptions)
 - [Php Dotenv Library](https://github.com/vlucas/phpdotenv)
 - [Firebase-JWT](https://github.com/firebase/php-jwt)
 - [Luthier-CI](https://github.com/ingeniasoftware/luthier-ci)
 - [Monolog](https://github.com/Seldaek/monolog)
 - [Faker](https://github.com/fzaninotto/Faker)

## Includes
 - Built-in `JWT` Library and JWT Library by  [Firebase](https://github.com/firebase/php-jwt)
 - `MY_Model` by [Avenir](https://github.com/avenirer/CodeIgniter-MY_Model)
 - `Monolog` PSR3 Logger Integration
 - `MY_Controller` for REST API calls
 - `constants.php` with some extra goodies
 - Luthier routing for Codeigniter 3
 - Chris Kacerguis/Phil Sturgeon's REST Library
 - Complete composer dependency control
 - Most commonly used libraries/helpers are autoloaded
 - Whoops Errors for Cool Kids integration
 - PHP Dotenv library integration
 - Proper environmental configuration setup
 - A very series of robust helper files from CLI to Databases
 - Migration files for ci_sessions and the REST Library
 - And more... take a look!
 
## Project Setup
### Install Dependencies
```
$ cd path/to/application
$ composer install
```

### Update Dependencies
```
$ cd path/to/application
$ composer update
```

### Run local development server
```
$ cd path/to/public_html
$ php -S localhost:8080
```
Navigate to localhost:8080 to run the development server

### INSTALL NOTES:
1. Clone or download this repo into your directory of choice
2. Ensure that your web server 'points' to the `public_html` directory
 - Do NOT access the `public_html` directory directly from your browser [EG - `http:/mysite.com/public_html/`]. Always set your web server to 'point' to your `public_html` directory. This is done for security reasons.
3. `$ cd path/to/application` and then run the `composer install` command
4. Access your new API and Enjoy!

### OTHER NOTES:
- Please read the docs of the Luthier-CI package if you've questions regarding routing and middleware. You can find the docs for that plugin [here](https://github.com/ingeniasoftware/luthier-ci)
- Update files manually that exist inside of the `application` folder as well as a modified version of the `index.php` 
 file if it exists
  - Check the [CodeIgniter User Guide](http://www.codeigniter.com/user_guide/installation/upgrading.html) for more information.

### CLI Commands
To execute the following commands: `$ cd public_html` directory and run:

````
// Creating a controller:
$ php index.php luthier make controller ControllerName

// Creating a model:
$ php index.php luthier make model ModelName

// Creating a library:
$ php index.php luthier make library LibraryName

// Creating a helper:
$ php index.php luthier make helper HelperName

// Creating a middleware:
$ php index.php luthier make middleware MiddlewareName

// Creating a migration (by default, migrations are created by date)
$ php index.php luthier make migration create_users_table
$ php index.php luthier make migration create_users_table date
$ php index.php luthier make migration create_users_table sequential
````

To run migrations:
````
$ php index.php luthier migrate [version?=latest]
```` 
Where version is the version of the migration to run. If it's omitted, it will proceed to migrate to the latest available version.

NOTE: It's also possible to use one of these special values as version:

 - reverse: reverses ALL migrations
 - refresh: reverses ALL migrations and then proceeds to migrate to the latest available version

Examples
````
$ php index.php luthier migrate reverse
$ php index.php luthier migrate refresh
````
