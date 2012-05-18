<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */
 
/**
 * this file configures our service container, which most of the application
 * is dependant on the databases, templating, routing and caching
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
 
use Wheel\Services;
use Wheel\Router;

$services = new Services();

/* database connections are expensive, using the config means its created only
 * when needed
 */
$services->addConfigs(array(
  'database'  => array(
    'class'   => '\\PDO', 
    'params'  => array('mysql:host=127.0.0.1;dbname=wheel', 'root')),
));

// configuring twig
$services->addServices(array(
  'router'  => new Router(),
  'twig'    => new Twig_Environment(new Twig_Loader_Filesystem($config['twig']['template_dir']), $config['twig']['config']),
));

return $services;