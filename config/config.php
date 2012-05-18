<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */
 
/**
 * this is our config file, paths, database connection information should be
 * kept here, then the other config files such as router.php, services.php and
 * autoload.php can use it to help configure them.
 * 
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */

$config = array(
  'base' => array(
    'twig' => array(
      'config' => array(),
      'template_dir' => __DIR__.'/../templates/default',
    )
  ),
  'prod' => array(
    'twig' => array(
      'config' => array(
        'cache' => __DIR__.'/../cache/twig'),
    )
  ),
  'dev' => array(
    'twig' => array(
      'config' => array(),
    )
  )
);

/* here we are taking the base config, and recersively merging it with our chosen env.
 */
return array_merge_recursive($config['base'], $config[env], array('env' => env));