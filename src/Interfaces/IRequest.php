<?php

namespace FcPhp\Request\Interfaces
{
	interface IRequest
	{
		public function __construct(array $server);

		public function get(string $key = null);

		public function isConsole() :bool;
	}
}