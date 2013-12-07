<?php

/*
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */
 
/**
 * This file configures our service container, which allows for depencancy injection
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */

return array(
	'database' => array(
		'singleton' => true,
		'class' => 'PDO',
		'params' => array('mysql:host=127.0.0.1;dbname=wheel', 'root')),

	'router' => array(
		'singleton' => true,
		'class' => 'Wheel\\Router',
		'params' => array()),

	'twig.loader' => array(
		'singleton' => true,
		'class' => 'Twig_Loader_Filesystem', 
		'params' => array($config['twig']['template_dir'])),

	'twig' => array(
		'singleton' => true,
		'class' => 'Twig_Environment',
		'params' => array('%twig.loader%', $config['twig']['config']))
);