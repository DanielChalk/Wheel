<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */

namespace Wheel;
use Wheel\Route\Route;

/**
 * Router
 * This class is used to find the actions to execute and to generate urls
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
class Router 
{
  protected $route;
  
  public function __construct()
  {
    $this->route = array();
  }
  
  public function add($name, Route $route)
  {
    $this->routes[$name] = $route;
  }
  
  public function find($url)
  {
    foreach($this->routes as $route)
    {
      if($route->isMatch($url))
      {
        return $route;
      }
    }
  }
}
