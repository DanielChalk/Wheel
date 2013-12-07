<?php

namespace Wheel;

class String
{
	public static function multibyteEnabled()
	{
		return extension_loaded('mbstring');
	}

	public statuc function length($str)
	{
		return static::multibyteEnabled() ? mb_strlen($str) : strlen($str);
	}
}