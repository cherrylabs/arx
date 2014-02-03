# Arx full demo project with vendors

[![Latest Stable Version](https://poser.pugx.org/arx/core/v/stable.png)](https://packagist.org/packages/arx/core) [![Total Downloads](https://poser.pugx.org/arx/core/downloads.png)](https://packagist.org/packages/arx/core) [![Latest Unstable Version](https://poser.pugx.org/arx/core/v/unstable.png)](https://packagist.org/packages/arx/core)

This is the full demo project including vendors and packages. All you have to do is extract the archive and access to the public folder with Mamp/Wamp/Xampp.

If your new with Laravel, we highly recommend you to read his wonderfull docs here first : [http://laravel.com/docs](http://laravel.com/docs)

## Requirements

- PHP > 5.3
- Composer [follow these steps](http://getcomposer.org/doc/00-intro.md)

## Recommended

 - Nodejs to handle your asset package
 - Bower to install package
 - Grunt

## What's bundled here ?

Arx project propose a clean startup project template to start with Laravel, Bootstrap, and Angular. It includes :

 - Laravel
 - Arx Core as an extension of Laravel (see https://github.com/cherrylabs/arx-core) for more informations
 - Usefull extra vendors package like :
    - better debug var_dump with Kint
    - Assets management
    - ide-helper generator
    - laravel debug-bar
    - way generators
    - orchestra admin system


## How to install ?

Simply extract https://github.com/cherrylabs/arx/archive/master.zip to your localhost folder and that's it.

### Permissions

/!\ After installing Laravel, you may need to grant the web server write permissions to the app/storage directories. See the [Installation documentation for more details on configuration](http://laravel.com/docs/installation).

## How to run ?

If you have Mamp\Wamp or you have simply run to the localhost/{path to your project}

If you don't have it, you can run in the terminal (at the root of your project)

    php artisan serve

Then you will get access to your project via : http://localhost:8000

This is a 'ready-to-learn' packages of Arx. It includes examples of how to use Arx and arx template inside [/app/controllers/ExampleController.php](https://github.com/cherrylabs/arx/blob/master/app/controllers/ExampleController.php).

/!\ this is not a package for production purpose, you may prefer to use [https://github.com/cherrylabs/arx-project](https://github.com/cherrylabs/arx-project) if you want to start with a clean starter project.

## How to report a bug or suggestion ?

If you want to report a bug or a suggestion, please go to our centralized issues tracker  [our issues tracker](https://github.com/cherrylabs/arx/issues?labels=bug&milestone=&page=1&state=open)

## How to contribute ?

If you want to contribute to the Arx project, please go on our [Arx-contrib repository](https://github.com/cherrylabs/arx-contrib)

# What's new ? :

## 4.1.x

- Compatibility with Laravel 4.1
- Documentation has moved to his own repository for better download performance
- The version will follows the Laravel version number to avoid complications so we skip the 3 version !
- Config classes from Arx are now usable outside Laravel ! Just call new Arx\classes\Config() see

## 3.x

- Skipped to follow Laravel Version conventions ! (see above)

## 2.3.x

- Compatibility with Laravel 4.0

## 2.x (beta) Features

- Improve compatibility add somes functions

## 1.0.x (alpha) Features

- allow to use a different structure than default Laravel structure => instead to call in public/index.php ../bootstrap/start.php => just require ../vendor/autoload.php then $app = new arx() (so know you can work in another structure than Laravel by default)
- add some useful classes like Utils class (for better getJson, little template engine, Dummy class (image, text, video generator) for development etc.
- add Hash class to people that can't install mcrypt extension or is under PHP 5.3.7
- add possibility to have directly a facade function with resolve functions
- add Bootstrap layouts template for fast prototyping (see {vendor/workbench}/arx/core/src/views for more informations about available templates)

For the complete features : [check the documentation](http://www.arx.io/docs)

