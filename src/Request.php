<?php

namespace FcPhp\Request
{
	use FcPhp\Request\Interfaces\IRequest;

	class Request implements IRequest
	{
		private $server = [];
		private $http = [];
		private $console = [];

		public function __construct(array $server/*, IRoute $route, ICommand $command*/)
		{
			$this->server = $server;
			// $this->route = $route;
			// $this->command = $command;
			if(isset($this->server['REQUEST_METHOD'])) {
				$this->http();
			}else{
				$this->console();
			}
		}

		private function http()
		{
			$this->http = [
				'path' => $this->getContent('DOCUMENT_ROOT'),
				'script-name' => $this->getContent('SCRIPT_NAME'),
				'ip-client' => $this->getContent('REMOTE_ADDR'),
				'software' => $this->getContent('SERVER_SOFTWARE'),
				'server-name' => $this->getContent('SERVER_NAME'),
				'method' => $this->getContent('REQUEST_METHOD'),
				'host' => $this->getContent('HTTP_HOST'),
				'port' => $this->getContent('SERVER_PORT'),
				'uri' => $this->getContent('REQUEST_URI'),
				'user-agent' => $this->getContent('HTTP_USER_AGENT'),
				'query' => $this->getContent('QUERY_STRING'),
				'content-type' => $this->getContent('HTTP_CONTENT_TYPE'),
			];
			$this->route();
		}

		private function route()
		{
			// security http
			// $this->httpSecurity->run($this->http);

			// route
			// $this->route->run($this->http);
		}

		private function console()
		{
			$this->console = [
				'path' => $this->getContent('PWD'),
				'script-name' => $this->getContent('SCRIPT_NAME'),
				'home' => $this->getContent('HOME'),
				'lang' => $this->getContent('LANG'),
				'shell' => $this->getContent('SHELL'),
				'user' => $this->getContent('USER'),
				'username' => $this->getContent('USERNAME'),
				'params' => $this->getContent('argv'),
			];
			$this->command();
		}

		private function command()
		{
			// security console
			// $this->consoleSecurity->run($this->console);

			// command
			// $this->command->run($this->console);
		}

		private function getContent(string $key)
		{
			if(isset($this->server[$key])) {
				return $this->server[$key];
			}
			return null;
		}
	}
}