<?php

namespace FcPhp\Request
{
    use FcPhp\Request\Interfaces\IRequest;

    class Request implements IRequest
    {
        /**
         * @var array $server Args of server web/console
         */
        private $server = [];

        /**
         * @var array $http Args of http request
         */
        private $http = [];
        
        /**
         * @var array $console Args of console request
         */
        private $console = [];
        
        /**
         * Method to construct instance
         *
         * @param array $server Args of server web/console
         * @return void
         */
        public function __construct(array $server)
        {
            $this->server = $server;
            if(isset($this->server['REQUEST_METHOD'])) {
                $this->http();
            }else{
                $this->console();
            }
        }
        
        /**
         * Method to return information
         *
         * @param string $key Key to find
         * @return array|string
         */
        public function get(string $key = null)
        {
            if($this->isConsole()) {
                return $this->getAttribute($this->console, $key);
            }
            return $this->getAttribute($this->http, $key);
        }
        
        /**
         * Method to verify if call is console
         *
         * @return bool
         */
        public function isConsole() :bool
        {
            return count($this->console) > 0;
        }
        
        /**
         * Method to return attribute
         *
         * @param array $attribute List of attributes
         * @param string $key Key to find
         * @return array|string
         */
        private function getAttribute(array $attribute, string $key = null)
        {
            if(empty($key)) {
                return $attribute;
            }
            if(isset($attribute[$key])) {
                return $attribute[$key];
            }
            return null;
        }
        
        /**
         * Method to mount args of http request
         *
         * @return void
         */
        private function http() :void
        {
            $query = [];
            $queryString = $this->getContent('QUERY_STRING');
            if(!empty($queryString)) {
                parse_str($queryString, $query);
            }
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
                'query' => $query,
                'content-type' => $this->getContent('HTTP_CONTENT_TYPE'),
            ];
            $this->http['headers'] = $this->getContentList('HTTP_');
        }
        
        /**
         * Method to return list of "key" find in server
         *
         * @param string $key Key to find
         * @return array
         */
        private function getContentList(string $key) :array
        {
            $list = [];
            $length = strlen($key);
            foreach($this->server as $index => $value) {
                if(substr($index, 0, $length) == $key) {
                    $indexes = explode('_', $index);
                    $indexes = array_map(function($content) {
                        return strtolower($content);
                    }, $indexes);
                    $list[implode('-', $indexes)] = $value;
                }
            }
            return $list;
        }
        
        /**
         * Method to mount args of console request
         *
         * @return void
         */
        private function console() :void
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
        }
        
        /**
         * Method to return content of attribute server
         *
         * @param string $key Key to find
         * @return string|null
         */
        private function getContent(string $key)
        {
            if(isset($this->server[$key])) {
                return $this->server[$key];
            }
            return null;
        }
    }
}
