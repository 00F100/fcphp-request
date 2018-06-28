<?php

use FcPhp\Request\Request;
use FcPhp\Request\Interfaces\IRequest;
use PHPUnit\Framework\TestCase;

class RequestIntegrationTest extends TestCase
{
	private $instance;

	public function setUp()
	{
		$__server = [
			'REQUEST_METHOD' => 'GET',
		];
		$this->instance = new Request($__server);
	}

	public function testInstance()
	{
		$this->assertTrue($this->instance instanceof IRequest);
	}
}