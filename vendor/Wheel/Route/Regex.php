<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */

namespace Wheel\Route;

use Wheel\Route\Route;

/**
 * Regex Route
 * This allow for more dynamic URL's and private parameters / arguments to our
 * actions  
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
class Regex extends Route
{
  public function isMatch($path)
  {
    return preg_match($this->path, $path) > 0;
  }
  
  public function getAction($path)
  {
    $params;
    preg_match($this->path, $path, $params);
    unset($params[0]);//we don't need the full match
    //this really needs some improvement but should work for the time being
    $this->action->setParams(array_merge($this->action->getParams(), $params));
    
    return $this->action;
  }
}
