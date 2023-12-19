<?php
    namespace app\core;
    class Request
    {
        public function getPath()
        {
            $path = $_SERVER['REQUEST_URI'] ?? '/';
            $postion = strpos($path,'?');
            if($postion=== false)
            {
                return $path;
            }
            return substr($path,0,$postion);
        }
        public function getMethod()
        {
            return strtolower($_SERVER['REQUEST_METHOD']) ;
        }
        public function isGet()
        {
            return $this->getMethod() === 'get'?true:false;
        }

        
        public function isPost()
        {
            return $this->getMethod() === 'post'?true:false;
        }

        public  function getBody()
        {
            $body =[];
            if( $this->getMethod() ==='get')
            {
            
                foreach($_GET as $key => $value)
                {
                    if(is_array($value))
                    {
                        $body[$key] = filter_input(INPUT_GET , $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    }else
                    {
                        $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }

            if( $this->getMethod() === 'post')
            {
                foreach($_POST as $key => $value)
                {
                
                    if(is_array($value))
                    {
                        $body[$key] = filter_input(INPUT_POST , $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    }else
                    {
                        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            
            }
        
            return $body;
        }
        public function getFiles()
        {
            $files = [];
    
            if ($this->getMethod() === 'post') {
                $files = $_FILES;
            }
    
            return $files;
        }
    }