<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */

namespace Wheel\Route;
/**
 * String base route
 * This is the most basic route, the path in the url MUST match the path given
 * in the route for there to be a match
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
class String extends Route
{
  public function isMatch($path)
  {
    return $this->path == $path;
  }
  
  public function getAction($path)
  {
    return $this->action;
  }
}