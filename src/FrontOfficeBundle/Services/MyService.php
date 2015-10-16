<?php

namespace FrontOfficeBundle\Services;

class MyService
{

	public function __construct($em)
	{
		echo 'construct:';		
	}

	public function test()
	{
		echo 'test';
	}
}