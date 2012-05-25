<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */

namespace Wheel\Route;

use Wheel\Route\Route;

/**
 * Route with named vars
 * There is quite a bit of regex and string manipulation  in these routes, 
 * it's best to create them and cache.
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
class NamedVars extends Route
{
  protected $_params;
  protected $_regex;

  public function isMatch($path)
  {
    return preg_match($this->_regex, $path);
  }

  public function getAction($path)
  {
    // this section gets the values from our path
    $params;
    preg_match($this->_regex, $path, $params);
    unset($params[0]);
    
    // get the values from the $params array into $this->_params
    foreach(array_keys($this->_params) as $i => $key)
    {
      $this->_params[$key] = $params[$i+1];
    }
    
    // setParams returns $this (Wheel\Action)
    return $this->action->setParams(array_merge($this->action->getParams(), $this->_params));
  }

  protected function configure()
  {
    //initialise _params
    $this->_params = array();
    
    // GENERATE REGEX
    // Escape the foward slashes
    $this->_regex = str_replace('/', '\/', $this->path);
    // Now lets create some regex
    $this->_regex = "/".preg_replace('/{\w+}/', '(\w+)', $this->_regex)."/";
    
    //Extra 
    $params;
    if(preg_match_all('/{(\w+)}/', $this->path, $params))
    {
      $this->_params = array();
      
      foreach($params[1] as $param_name)
      {
        $this->_params[$param_name] = null;
      }
    }
  }

}
