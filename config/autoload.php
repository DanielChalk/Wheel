<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */
 
/**
 * this is the place where we map namespaces to specific directory, allowing us
 * to manage our libaries  and separate them from the applications source.
 * 
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */

require_once __DIR__ .'/../vendor/Wheel/Loader.php';
require_once __DIR__ .'/../vendor/Twig/lib/Twig/Autoloader.php';

Twig_Autoloader::register();
use Wheel\Loader;

$loader = new Loader();
//src is where the application will live
$loader->setFallback(__DIR__.'/../src');

//register our namespaces
$loader->registerNamespaces(array(
  //The Wheel namespace for parts of the framework
  'Wheel' => __DIR__.'/../vendor',
));

return $loader;