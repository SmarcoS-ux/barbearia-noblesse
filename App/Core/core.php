<?php
    class Core {
        public function start($urlGet){
            $method = "index";
            
            if(isset($urlGet['page'])){
                $controller = ucfirst($urlGet['page'])."Controller";
            } else{
                $controller = "HomeController";
            }

            if(!class_exists($controller)){
                $controller = "ErroController";
            }

            call_user_func_array(array(new $controller, $method), array());
        }
    }