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

require dirname(__DIR__).'/app.php';
