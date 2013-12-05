<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */
 
/**
 * this file configures our router, which matches paths given in the url to 
 * routes you define in this file, allowing the application to know what
 * controller and actions to execute.
 * 
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */

use Wheel\Router;
use Wheel\Route\String as stringRoute;
use Wheel\Route\Regex as regexRoute;
use Wheel\Route\NamedVars as varRoute;
use Wheel\Action;

$router = $services->get('router');
/* there two are for our home page, just in case we get an empty path, we can 
 * still get a default page. 
 */
$router->add('homepage', new stringRoute('/', new Action('Controller\\Home', 'index')));
$router->add('homepage_', new stringRoute('', new Action('Controller\\Home', 'index')));
$router->add('help', new stringRoute('/help', new Action('Controller\\Help', 'index')));

if($config['env'] == 'dev')
{
  //we got to have our test modules 
  $router->add('test', new stringRoute('/test', new Action('Controller\\Test', 'index')));
  $router->add('regex_test', new regexRoute('/^\/hello\/(\w*)/', new Action('Controller\\Test', 'hello')));  
  
  $router->add('named', new varRoute('/hi/{first_name}/{last_name}', new Action('Controller\\Test', 'hello')));
}

return $router;
