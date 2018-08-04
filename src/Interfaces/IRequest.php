<?php

namespace FcPhp\Request\Interfaces
{
    interface IRequest
    {
        /**
         * Method to construct instance
         *
         * @param array $server Args of server web/console
         * @return void
         */
        public function __construct(array $server);
        
        /**
         * Method to return information
         *
         * @param string $key Key to find
         * @return array|string
         */
        public function get(string $key = null);
        
        /**
         * Method to verify if call is console
         *
         * @return bool
         */
        public function isConsole() :bool;
    }
}
