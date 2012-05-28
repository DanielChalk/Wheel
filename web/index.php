<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
 
//defines the env we are running and what config to use. 
if(!defined('env'))
{
  define('env', 'prod');
}

use Wheel\Front;

/* Our settings will eventually live here, data such as database connection info
 * and caching rules should live there then the autoload.php, services.php and
 * router.php files can make use of them.
 * 
 * this file is dependant on env being defined.
 */
$config = include __DIR__.'/../config/config.php';

/* We will make an instance of Wheel\Loader here and add all the relevant paths
 * we will then register the loader here or in autoload.php
 */
$loader = include __DIR__.'/../config/autoload.php';
$loader->register();

/* Just like the loader we are defining our service contrainer (Wheel\Service)
 * in the file below and returning it here
 */ 
$services = include __DIR__.'/../config/services.php';

/* Initialising and configuring our router for all our pages, we current support
 * two types of route. One a static path and another for dynamic paths through
 * the use of regex.
 */
$router = include __DIR__.'/../config/router.php';

/* Make an instance of our front controller, this is where all the magic starts
 * to happen.
 * 
 * $services much be passed to it so it can pass services onto the controllers
 * for our actions to make use of. 
 */
$front = new Front($services);

/* We are now dispatching our front controller to find and execute an action 
 * based on the request.
 * 
 * The reason we echo the response here is so we can add some caching later on
 * for reasonably static pages
 */
 
$path = urldecode(str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['REQUEST_URI']));
 
$response = $front->dispatch($path);

/* Our response must either be a string or an object that implements the 
 * __toString() method
 */
echo $response;

