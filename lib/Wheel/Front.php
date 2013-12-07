<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */

namespace Wheel;
use Wheel\Action;

/**
 * Front controller
 * This is where the magic happens, will the use the router to find the correct
 * controller and action to use or display an error page on failure.
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
class Front
{
  /**
   * @var Wheel\Services
   */
  protected $services;
  
  /**
   * Front constructor
   * @param Wheel\Services $services
   */
  public function __construct(Service $services)
  {
    $this->services = $services;
  }
  
  public function dispatch($path = null)
  {
    try
    {
      $action = $this->getAction($path);
      return $action->execute($this->services);
    }
    catch(\Exception $e)
    {
      $action = new Action('Wheel\Controller\Error', 'index', array($e));
      return $action->execute($this->services);
    }
  }
  
  /**
   * @param string $path
   * @throws \Exception
   * @return Wheel\Action
   */
  protected function getAction($path)
  {
    $route = $this->services->get('router')->find($path);
    
    if(!$route)
    {
      throw new \Exception(sprintf('route %s not found', $path));
    }
    
    return $route->getAction($path);
  }
}
