<?php

namespace Trix;

class Module 
{
	function __get($key)
	{
		return \CI::$APP->$key;
	}
}