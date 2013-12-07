<?php

namespace Wheel;

use \ReflectionClass;
use Wheel\Exception\MissingServiceClass;
use Wheel\Exception\ServiceNotFound;

class Service
{
	protected $initialised;
	protected $singletons;
	protected $services;

	public function __construct()
	{
		$this->initialised = array();
		$this->singletons = array();
		$this->services = array();
	}

	/**
	 * retrieve specified service
	 * @param  string $name
	 * @throws  ServiceNotFound
	 * @return mixed
	 */
	public function get($name)
	{
		if(array_key_exists($name, $this->initialised))
		{
			return $this->initialised[$name];
		}
		elseif(array_key_exists($name, $this->singletons))
		{
			return $this->initialise($name);
		}
		elseif(array_key_exists($name, $this->services))
		{
			return $this->services[$name]($this);
		}		

		throw new ServiceNotFound($name);
	}

	/**
	 * Does specified service exist
	 * @param  string $name
	 * @return bool
	 */
	public function exists($name)
	{
		return array_key_exists($name, $this->initialised) || 
			array_key_exists($name, $this->singleton) || 
			array_key_exists($name, $this->services);
	}

	/**
	 * Add a singleton service using a closure
	 * @param  string  $name
	 * @param  Closure $callable
	 * @return Wheel\Service
	 */
	public function singleton($name, $settings)
	{
		$this->singletons[$name] = is_callable($settings) ? $settings : $this->createClosure($settings);
		return $this;
	}

	/**
	 * Add a service using a closure
	 * @param  string  $name
	 * @param  Closure $callable
	 * @return Wheel\Service
	 */
	public function register($name, $settings)
	{
		$this->services[$name] = is_callable($settings) ? $settings : $this->createClosure($settings);
		return $this;
	}

	/**
	 * create a closure that can be called when needed to create a service
	 * @param string $name
	 * @param array $config
	 * @throws MissingServiceClass
	 * @return callable
	 */
	protected function createClosure($config)
	{
		/*	currently services must be a class so the parameter is expected
			however in future i might allow for methods. */
		if(!array_key_exists('class', $config))
		{
			throw new MissingServiceClass('class');
		}

		return function(Service $service) use ($config) {

			$refClass = new ReflectionClass($config['class']);

			//check if we are dependant on another service
			foreach($config['params'] as $key => $param)
			{
				/*	If we are referencing another service we will see modulas (%) either side
				   	of the string */
				if(is_string($param) && $param[0] == '%' && $param[strlen($param)-1] == '%')
				{
					//retreive the referenced service, trimming the modulas from the string first
					$config['params'][$key] = $service->get(trim($param, '%'));
				}
			}

			return $refClass->newInstanceArgs($config['params']);
		};
	}

	/**
	 * Create install of singleton and store it for reuse.
	 * @param  string $name
	 * @return mixed
	 */
	protected function initialise($name)
	{
		return $this->initialised[$name] = $this->singletons[$name]($this);
	}
}