<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */

namespace Wheel;

/**
 * Base class for controllers, I should have named it better and will refactor
 * 
 * All controllers must extends this class so the service container is 
 * accessible
 *  
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
abstract class Actions
{
  /**
   * @var Wheel\Services
   */
  protected $services;
  
  /**
   * @param Wheel\Service
   */
  public function __construct(Service $services)
  {
    $this->services = $services;
  }
  
  /**
   * get service
   * @return mixed
   */
  public function get($service_name)
  {
    return $this->services->get($service_name);
  }
}
