# FcPhp Request

Package to manage requests

[![Build Status](https://travis-ci.org/00F100/fcphp-request.svg?branch=master)](https://travis-ci.org/00F100/fcphp-request) [![codecov](https://codecov.io/gh/00F100/fcphp-request/branch/master/graph/badge.svg)](https://codecov.io/gh/00F100/fcphp-request) [![Total Downloads](https://poser.pugx.org/00F100/fcphp-request/downloads)](https://packagist.org/packages/00F100/fcphp-request)

## How to install

Composer:

```sh
$ composer require 00f100/fcphp-request
```

or add in composer.json

```json
{
	"require": {
		"00f100/fcphp-request": "*"
	}
}
```

## How to use

```php
<?php

use FcPhp\Request\Request;

$request = new Request($_SERVER);

if($request->isConsole()) {
	/*

	Console Request


	$request->console = [
		'path' => $_SERVER['PWD'],
		'script-name' => $_SERVER['SCRIPT_NAME'],
		'home' => $_SERVER['HOME'],
		'lang' => $_SERVER['LANG'],
		'shell' => $_SERVER['SHELL'],
		'user' => $_SERVER['USER'],
		'username' => $_SERVER['USERNAME'],
		'params' => $_SERVER['argv'],
	];
	*/
	// Print: $request->console['path'] => $_SERVER['PWD']
	echo $request->get('path');

} else {
	/*

	Web Request


	$request->http = [
		'path' => $_SERVER['DOCUMENT_ROOT'],
		'script-name' => $_SERVER['SCRIPT_NAME'],
		'ip-client' => $_SERVER['REMOTE_ADDR'],
		'software' => $_SERVER['SERVER_SOFTWARE'],
		'server-name' => $_SERVER['SERVER_NAME'],
		'method' => $_SERVER['REQUEST_METHOD'],
		'host' => $_SERVER['HTTP_HOST'],
		'port' => $_SERVER['SERVER_PORT'],
		'uri' => $_SERVER['REQUEST_URI'],
		'user-agent' => $_SERVER['HTTP_USER_AGENT'],
		'content-type' => $_SERVER['HTTP_CONTENT_TYPE'],
		'query' => [],
		'headers' => [],
	];
	*/
	// Print: $request->http['method'] => $_SERVER['REQUEST_METHOD']
	echo $request->get('method');
}
```