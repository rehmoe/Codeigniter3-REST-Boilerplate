 # CodeIgniter REST API Boilerplate
 
  - The current stable version is [v.1.1.0](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate/releases/tag/1.1.0)

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
 - [License](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate#license)
 
# Synopsis

 
This is an MVC boilerplate for REST APIs powered by PHP, JWT, Composer and Codeigniter 3 with CLI based code generation. If you'd like to see the Postman docs for the provided `Sessions`, `Home` & `JWT` examples, you can visit this [link](https://documenter.getpostman.com/view/1486787/RznBMKeo). To check out the official versioned releases of this repo, go [here](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate/releases). 

I built this as a small scaffold for my API based projects and tried making it as 
un-opinionated as possible. It contains a number of cool features for REST 
APIs such as a built-in JWT library, static routes and middleware brought to us by the amazing 
`Luthier-CI` package, a proper REST Controller library brought to us by Phil Sturgeon
and Chris Kacerguis, a small but useful `MY_Controller` and an extensive 
`MY_Model`. Also included is a cool assortment of
composer dependencies and integration for libraries like `Monolog` PSR3 
Logger library, Dotenv by Vance Lucas for Environment configuration and 
Whoops Errors for Cool Kids for API/UI errors during development as well as a 
series of helper files, hooks and migrations to make the instantiation of REST 
APIs far quicker and far more simple. 

I primarily build APIs and I absolutely love working with the 
CodeIgniter framework and I wanted to keep the DRY KISS approach in all of my future API projects, while modernizing CodeIgniter 3
to allow it to be used for years to come with best practices at the forefront of boilerplate's design and structure.
This is due to me wanting to eliminate the need to repeat tasks that are common when setting up an API focused
'micro-framework' using Codeigniter. 

Please note, that this boilerplate is geared towards building only APIs and not initially built  for User Interface 
mechanics (although that still can be done). 

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
 - [Luthier-CI](https://github.com/ingeniasoftware/luthier-ci)
 - [Monolog](https://github.com/Seldaek/monolog)
 - [Faker](https://github.com/fzaninotto/Faker)

## Includes
 - Built-in `JWT` Library (See the example [Controller](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate/blob/master/application/controllers/JWTController.php), [Routes](https://github.com/jason-napolitano/Codeigniter3-REST-Boilerplate/blob/master/application/routes/api.php#L13) & [Docs](https://documenter.getpostman.com/view/1486787/RznBMKeo#3835e400-9fbc-4b9b-b90d-7a46da6e891d))
 - `MY_Model` by [Avenir](https://github.com/avenirer/CodeIgniter-MY_Model)
 - Code Generator for Controllers, Models, Helpers, Migrations and Libraries
 - `MY_Log` file for `Monolog` PSR3 Logger Integration
 - A simple `MY_Controller` class to extend for basic REST usage
 - A revised `constants.php` with some cool, extra goodies
 - Luthier routing/middleware for Codeigniter 3
 - Chris Kacerguis/Phil Sturgeon's REST Library
 - Complete composer dependency control
 - Most commonly used libraries/helpers are autoloaded
 - Whoops Errors for Cool Kids integration
 - PHP Dotenv library integration
 - A series of robust helper files from CLI's to Databases
 - Migration files for all of the database tables, including `ci_sessions` and the REST Library
 - Example Controllers, Routes, Model and Migration files to demonstrate the API
   - Example Postman documentation for this is included
 - And much more... It is best to just go ahead and take a look!
 
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

If you want database sessions, and to use the included API examples:
1. Go to `application/config/ENVIRONMENT/database.php` and enter your database credentials
2. Go to `application/config/ENVIRONMENT/config.php` and change the session type to database sessions located on `line 382`
3. Open your command line tool (EG - Git Bash) and run `$ cd path/to/public_html` then run the migration command `$ php index.php luthier migrate`
4. Access your new API and Enjoy!

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
$ php index.php luthier migrate
````
This will migrate to the latest available version

````
$ php index.php luthier migrate 20170706025420
````
This will run the  `20170706025420_create_table_users` migration file

It's also possible to use one of these special values as version:

 - `reverse` reverses ALL migrations
````
$ php index.php luthier migrate reverse
````
 - `refresh` reverses ALL migrations and then proceeds to migrate to the latest available version
 ````
$ php index.php luthier migrate refresh
````

### Running the SQL File:
Alternately, you may simply import the SQL file located at `APPPPATH/database/sql/rest_api.sql` into 
your favorite RDBMS to get the desired tables.

# TODO's
A small list of things I would like to do by the version 2.0.0 release:

 - ~~A small example using Codeigniter sessions.~~ (Released in v1.0.0)
   - ~~Migration file~~
   - ~~A controller~~
   - ~~A model~~
   - ~~Routes~~
   - ~~Docs~~
   
 - Finish refactoring the migration files and get them working fully
   - I am thinking that the `Luthier-CI` package is having issues when running migrations where all migrations do not run. i expect that this will be fixed for the 1.2.0 release 

 - An example representation of JWT authentication. This should be ready by the 2.0.0 release.
   - Using an JWTAuthMiddleware

# License
### MIT License

Copyright 2019 Jason Napolitano

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
