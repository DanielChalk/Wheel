<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */

namespace Wheel;
use Wheel\Service;

/**
 * Services Container 
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
class Services
{
  private $services;
  private $configs;
  
  public function __construct()
  {
    $this->services = array();
    $this->configs = array();
  }
  
  /**
   * @param string $name
   * @throws Exception
   * @return Wheel\Service
   */
  public function get($name)
  {
    //if the instance of that service already exists
    if(isset($this->services[$name]))
    {
      return $this->services[$name];
    }      
    
    //is the services defined in the config, if so make an instance
    if(isset($this->configs[$name]))
    {
      //get our class name & arguments
      $class = $this->configs[$name]['class'];
      $params = isset($this->configs[$name]['params']) ? 
        $this->configs[$name]['params'] : array();
      
      //make a new instance of our class along with its params
      $reflection_class = new \ReflectionClass($class);
      $service = $reflection_class->newInstanceArgs($params);
      
      //store our service with the other instance and return it
      return $this->set($name, $service)->get($name);
    }
    
    throw new Exception(sprintf('unknown service %s', $name));
  }
  
  /**
   * @param string $name
   * @param object $service
   * @return Wheel\Services
   */
  public function set($name, $service)
  {
    $this->services[$name] = $service;
    
    return $this;
  }
  
  /**
   * @param Service[]
   * @return Wheel\Services
   */ 
  public function addServices(array $services)
  {
    foreach($services as $name => $service)
    {
      $this->set($name, $service);
    }
    
    return $this;
  }
  
  /**
   * @param mixed
   * @return Wheel\Services
   */ 
  public function addConfigs(array $configs)
  {
    foreach($configs as $name => $config)
    {
      $this->addConfig($name, $config);
    }
    
    return $this;
  }
  
  /**
   * @param string $name
   * @param array $config
   * @return Wheel\Services
   */
  public function addConfig($name, array $config)
  {
    $this->configs[$name] = $config;
    return $this;
  }
}
