<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */

namespace Wheel\Route;

use Wheel\Action;

/**
 * Route base class.
 * 
 * If you want to make a custom route class to use without router, you must 
 * extends and conform to this class.
 * 
 * I may refactor this into an interface
 * 
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
abstract class Route
{
  protected $path;
  
  public function __construct($path, Action $action)
  {
    $this->path = $path;
    $this->action = $action;
    $this->configure();
  }
  
  public abstract function isMatch($path);
  
  public abstract function getAction($path);
  
  protected function configure() {}
}
