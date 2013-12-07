<?php

/*
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */

/**
 * This is where we take the services specification and add them to the container
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */

use Wheel\Service;
use Wheel\Router;

/* database connections are expensive, using the config means its created only
 * when needed
 */
$services = new Service();

$specifications = require __DIR__.'/config/services.php';

foreach($specifications as $name => $spec)
{
	if(array_key_exists('singleton', $spec) && $spec['singleton'] == true)
	{
		$services->singleton($name, $spec);
	}
	else
	{
		$services->register($name, $spec);
	}
}

return $services;