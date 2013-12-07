<?php

namespace Wheel

class Service
{
	protected $initialised;
	protected $singletons;
	protected $services;
	protected $configs;

	public function __construct()
	{
		$this->initialised = array();
		$this->singletons = array();
		$this->services = array();
		$this->configs = array();
	}

	public function get($name)
	{
		throw new Exception('Not implemented.');
	}

	public function singleton($name, Closure $callable)
	{

	}

	public function service($name, Closure $callable)
	{

	}

	public function config($name, array $config)
	{

	}
}