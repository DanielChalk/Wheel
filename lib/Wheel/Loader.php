<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */

namespace Wheel;

/**
 * Autoloader
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
class Loader
{
  protected $namespaces;
  protected $fallback;
  
  public function __construct()
  {
    $this->namespaces = array();
  }
  
  /**
   * Register a group of namespaces
   * @param string[] $namespaces
   * @return Loader
   */
  public function registerNamespaces(array $namespaces)
  {
    foreach ($namespaces as $namespace => $path)
    {
      $this->registerNamespace($namespace, $path);
    }

    return $this;
  }

  /**
   * Register a namespace and its path
   * @param string $namespace
   * @param string $path
   * @return Loader
   */
  public function registerNamespace($namespace, $path)
  {
    $this->namespaces[$namespace] = $path;
    return $this;
  }

  /**
   * @param string $path
   * @return Loader
   */
  public function setFallback($path)
  {
    $this->fallback = $path;
  }

  /**
   * Registers the loader with the runtime
   * @return bool
   */
  public function register()
  {
    return spl_autoload_register(array($this, 'load'), true);
  }

  /**
   * class loader
   * This is where it all happens
   * @param string $classname
   */
  public function load($classname)
  {
    //lets check our namespace paths first
    foreach ($this->namespaces as $namespace => $path)
    {
      //we need the length for the substring test two lines below
      $namespace_length = strlen($namespace);

      //if the namespace is in the first x many chars of the classes name
      if ($namespace == substr($classname, 0, $namespace_length))
      {
        //make the full path of the file
        $class_path = sprintf('%s/%s.php', $path, str_replace('\\', '/', $classname));

        //if the file exists require_once it
        if (is_file($class_path))
        {
          require_once $class_path;
          return;
        }
      }
    }
    
    //check if we have a fall back path to use
    if(isset($this->fallback))
    {
      //ok time to fall back to the easiest place to look
      $class_path = sprintf('%s/%s.php', $this->fallback, str_replace('\\', '/', $classname));
      //if the file exists require_once it
      if (is_file($class_path))
      {
        require_once $class_path;
      }
    }
  }
}
