<?php

namespace Wheel;

use \Exception;

class MissingServiceClass extends Exception
{
	public function __construct($class, $code = 0, Exception $previous = null);)
	{
		parent::__construct("Service classname \"$class\" is missing", $code, $previous);
	}
}