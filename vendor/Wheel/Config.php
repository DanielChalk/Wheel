<?php

namespace Wheel;

class Config
{
  protected $config;
  
  public function __construct(array $config)
  {
    $this->config = $config;  
  }
  
  public function get($path)
  {
    if(!is_string($path))
    {
      throw new \Exception('string expected');
    }
    
    $nodes = explode('/', $path);
    
    //references can be confusing but when used correctly can save you memory :)
    $node =& $this->config;
    
    for($i = 0; $i < count($nodes); $i++)
    {
      if(!isset($node[$nodes[$i]]))
      {
        return false;
      }
      $node =& $node[$nodes[$i]];
    }
    return $node;
  }
}