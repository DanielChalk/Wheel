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
  /**
   * Stores the params found in our path and will be merged with actions params
   * in getAction.
   * @var array
   */
  protected $_params;
  /**
   * Our generated expression is kept here
   * @var string
   */
  protected $_regex;

  /**
   * This is the expression used for finding the characters we are willing to 
   * accept for our param names
   * \w = letters, numbers and underscores
   * @var string
   */
  const name_regex = '\w+';
  
  /**
   * This expression determines the characters we are willing to accept as 
   * values
   * [\w\-\s] = letter, numbers, underscores, dashes and spaces
   * @var string
   */
  const value_regex = '[\w\-\s]+';

  public function isMatch($path)
  {
    //our generated regex is being used here to test the path
    return preg_match($this->_regex, $path);
  }

  public function getAction($path)
  {
    //This section gets the values from our path
    $params;
    preg_match($this->_regex, $path, $params);
        
    //Get the values from the $params array into $this->_params
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
    
    /* GENERATE REGEX
     * 
     * Here we are converting our simple expression into a regular expression
     * NOTE: I have only used simple expressions at the moment
     * I will need to improve it so numbers, dashes, underscores as well as text
     * are detected.
     */
     
    // Escape the foward slashes ready to be used in the preg methods
    $this->_regex = str_replace('/', '\/', $this->path);
    
    // Now lets create some regex
    $this->_regex = "/".preg_replace('/{'.self::name_regex.'}/', '('.self::value_regex.')', $this->_regex)."/";
    
    /* We are now extracting the variable names from our path and preparing the 
     * extra params array ($this->_params) we defined so the values can be 
     * populated later
     */ 
     
    $params;
    
    //if we have matches start putting them into $this->_params as keys/indexes
    if(preg_match_all('/{('.self::name_regex.')}/', $this->path, $params))
    {
      $this->_params = array();
      
      foreach($params[1] as $param_name)
      {
        $this->_params[$param_name] = null;
      }
    }
  }

}
