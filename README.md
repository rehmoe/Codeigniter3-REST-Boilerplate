 # CodeIgniter REST API Boilerplate
 ## [Version 1.0.0](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate/releases/tag/1.0.0)
 
 This is an MVC boilerplate for REST APIs powered by PHP, JWT, Composer and Codeigniter 3. If you'd like to see the Postman docs for the provided 
 `Sessions` and `Home` examples, you can visit this [link](https://documenter.getpostman.com/view/1486787/RznBMKeo). To check out the official 
 versioned releases of this repo, go [here](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate/releases).

# T.O.C (Table of Contents)
 - [Synopsis](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate#synopsis)
 - [Folder Structure](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate#folder-structure)
 - [Useful Links](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate#useful-links)
 - [Requirements](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate#requirements)
 - [What's Included](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate#includes)
 - [Project Setup](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate#project-setup)
 - [Install notes](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate#install-notes)
 - [Other notes](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate#other-notes)
 - [CLI Commands](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate#cli-commands)
 - [TODO's](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate#todos)
 
# Synopsis
This is a boilerplate for REST APIs using Codeigniter 3. I built this as a 
small scaffold for my API based projects and tried making it as 
un-opinionated as possible. It contains a number of cool features for REST 
APIs such as a built-in JWT library, static routes and middleware brought to us by the amazing 
`Luthier-CI` package, a proper REST Controller library brought to us by Phil Sturgeon
and Chris Kacerguis, a small but useful `MY_Controller` and an amazing 
`MY_Model` brought to us by Avenir. Also included is a cool assortment of
composer dependencies and integration for libraries like `Monolog` PSR3 
Logger library, Dotenv by Vance Lucas for Environment configuration and 
Whoops Errors for Cool Kids for API/UI errors during development as well as a 
series of helper files, hooks and migrations to make the instantiation of REST 
APIs far quicker and far more simple.

I built this because I primarily build APIs and I absolutely love working with the CodeIgniter framework.
Also this was built to keep the DRY KISS approach in all of my future API projects, while modernizing CodeIgniter 3
to allow it to be used for years to come with best practices at the forefront of boilerplate's design and structure.
This is due to me wanting to eliminate the need to constantly adjust the Codeigniter 
folder structure and move the application directory outside of the publicly
accessible scope and to eliminate the need to repeat tasks like the need 
to constantly configure a composer.json file for dependencies or load 
helper files, separate the config into an environment based structure, 
initiate the REST Controller library, add a `MY_Model` file, monitor my dependencies, etc, etc, etc. Please 
note, that this boilerplate is geared towards building only APIs and not initially built  for User Interface 
mechanics (although that still can be done). 

After installation, run the sessions migration,
switch to database sessions and go to `http://mysite.com/sessions` in a Postman 
style app or via cURL, etc and test out a real time demonstration of this project.
Alternately, you can visit the Postman docs of this very example by going to this [link](https://documenter.getpostman.com/view/1486787/RznBMKeo)

I hope everyone enjoys this and finds it useful. Please feel free to offer
any advice or issue PRs and fixes where you see fit. All credit for the 
Codeigniter framework goes to the Codeigniter team at BCIT and credit for
the composer dependencies goes to their respective authors. Without their
work, this would've been a lot more difficult of an approach =)

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
│   ├── web.config      # Prebuilt web.config file for IIS servers
│   ├── .htaccess       # Prebuilt .htaccess
│   ├── .env            # Prebuilt .env file
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
 - A series of robust helper files from CLI to Databases
 - Migration files for ci_sessions and the REST Library
 - Example Controller, Model, Migration and Routes to demonstrate the API
 - Example Postman documentation for the aforementioned example included in the Repo
 - And much more... take a look!
 
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

## Install notes
1. Clone or download this repo into your directory of choice
2. Ensure that your web server 'points' to the `public_html` directory
 - Do NOT access the `public_html` directory directly from your browser [EG - `http:/mysite.com/public_html/`]. Always set your web server to 'point' to your `public_html` directory. This is done for security reasons.
3. `$ cd path/to/application` and then run the `composer install` command
4. Go to `application/config/ENVIRONMENT/database.php` and enter your database credentials (Where ENVIRONMENT is the environment you want to connect a database with, EG - production)

If you want database sessions, and to use the included API examples:
1. Go to `application/config/ENVIRONMENT/config.php` and change the session type to database sessions located on `line 382` (Where ENVIRONMENT is the environment you want to configure the sessions for)
2. Open your command line tool (EG - Git Bash) and run `$ cd path/to/public_html` then run the migration command `$ php index.php luthier migrate`
3. Access your new API and Enjoy!

## Other notes
- Please read the docs of the Luthier-CI package if you've questions regarding routing and middleware. You can find the docs for that plugin [here](https://github.com/ingeniasoftware/luthier-ci)
- Update files manually that exist inside of the `application` folder as well as a modified version of the `index.php` 
 file if it exists
  - Check the [CodeIgniter User Guide](http://www.codeigniter.com/user_guide/installation/upgrading.html) for more information.

## CLI Commands
To execute the CLI commands simply run `$ cd path/to/public_html`. Then use one of the following commands:

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
$ php index.php luthier make migration create_table_users
$ php index.php luthier make migration create_table_users date
$ php index.php luthier make migration create_table_users sequential
````

To run migrations:
````
$ php index.php luthier migrate [version?=latest]
```` 
Where version is the version of the migration to run. If it's omitted, it will proceed to migrate to the latest available version.

Examples
````
$ php index.php luthier migrate version
````
This will migrate to the latest available version

````
$ php index.php luthier migrate version 20170706025420
````
This will run the  `20170706025420_create_table_users` migration file

It's also possible to use one of these special values as version:

 - reverse: reverses ALL migrations
 - refresh: reverses ALL migrations and then proceeds to migrate to the latest available version

Examples
````
$ php index.php luthier migrate reverse
$ php index.php luthier migrate refresh
````

# TODO's
A small list of things I would like to do by the version 1.1.0 release:

 - ~~A small example using Codeigniter sessions.~~ (Released in v1.0.0)
   - ~~Migration file~~
   - ~~A controller~~
   - ~~A model~~
   - ~~Routes~~
   - ~~Docs~~
 - An example representation of authentication
   - Using an AuthMiddleware
     - Using basic auth
     - Using digest auth 
     - Using JWT for Auth
     - Using OAuth2 (maybe)
