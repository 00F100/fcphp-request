<?php

use FcPhp\Request\Request;
use FcPhp\Request\Interfaces\IRequest;
use PHPUnit\Framework\TestCase;

class RequestUnitTest extends TestCase
{
	private $instance;

	public function setUp()
	{
		$__server = [
			'REQUEST_METHOD' => 'GET',
			'SERVER_NAME' => 'http://localhost',
			'QUERY_STRING' => 'param1=value1&param2=value2',
			'HTTP_CONTENT_TYPE' => 'text/plain',
		    'HTTP_USER_AGENT' => 'PostmanRuntime/7.1.5',
		    'HTTP_ACCEPT' => '*/*',
		    'HTTP_CONTENT_LENGTH' => '15',
		    'HTTP_CONNECTION' => 'keep-alive',
		    'HTTP_HOST' => 'localhost:8000',
		    'HTTP_ACCEPT_ENCODING' => 'gzip, deflate',
		];
		$this->instance = new Request($__server);
	}

	public function testInstance()
	{
		$this->assertTrue($this->instance instanceof IRequest);
	}

	public function testGet()
	{
		$this->assertEquals($this->instance->get('method'), 'GET');
	}

	public function testGetNonExists()
	{
		$this->assertEquals($this->instance->get('test'), null);
	}

	public function testGetAll()
	{
		$this->assertTrue(is_array($this->instance->get()));
	}

	public function testConsole()
	{
		$__server = [
			'HOME' => '~',
			'USER' => 'user',
			'argv' => [
				'-d',
				'config'
			]
		];
		$instance = new Request($__server);
		$this->assertEquals($instance->get('user'), 'user');
		$this->assertEquals($instance->get('test'), null);
		$this->assertTrue(is_array($instance->get()));
	}
}