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
 * If you want to make a custom route class to use with our router, you must 
 * extend and conform to this class.
 * 
 * I may refactor this into an interface
 * 
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
abstract class Route
{
  /**
   * The path to be matches against.
   * 
   * @var string
   */
  protected $path;
  
  /**
   * Construct the route with the expected path to match and the action to be
   * executed.
   * 
   * @param string $path
   * @param Wheel\Action $action
   */
  public function __construct($path, Action $action)
  {
    //bind our arguments to our attributes/properties
    $this->path = $path;
    $this->action = $action;
    
    /* Call our configure method. Youu should override this configure in your
     * defived class, if you need to do any processing before the route is used.
     */
    $this->configure();
  }
  
  /**
   * Does the $path given match the path of the route?
   * 
   * @param string $path
   * @return bool
   */
  public abstract function isMatch($path);
  
  /**
   * Configure and return the action.
   * 
   * @param string $path
   * @return Wheel\Action
   */
  public abstract function getAction($path);
  
  /**
   * This method is there for you to override if you need to configure the route
   * before its used by the router.
   */
  protected function configure() {}
}
