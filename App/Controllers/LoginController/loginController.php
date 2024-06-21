<?php

    class LoginController {
        private static $isLogged = "";

        public function index($params = null){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/LoginPage');
            $twig = new \Twig\Environment($loader);

            $paramss = array();
            $paramss['logado'] = self::$isLogged;

            $template = $twig->load('login.html');
            $page = $template->render($paramss);

            try{
                Session::start_session();
                if(Session::getVariableSession('isLogged') == "True"){
                    $time = 0;
                    header("Refresh: $time; url=http://localhost/Barbearia-Noblesse/?page=profile");
                } 
                
                echo $page;

            } catch(Exception $err){
                echo "";
            }   
        }

        public static function getIsLogged(){
            return self::$isLogged;
        }

        private static function setIsLogged($params){
            self::$isLogged = $params;
        }

        public function verifyUser(){
            $dados = $_POST;

            $email = $dados['email'];
            $password = $dados['password'];

            LoginModel::setEmail($email);
            LoginModel::setPasswordHash($password);

            $logado = LoginModel::authenticationUser();
            
            self::$isLogged = $logado['return'];

            $this->index();
            
            if(Session::getVariableSession('isLogged') == "True"){
                $time = 2;
                header("Refresh: $time; url=http://localhost/Barbearia-Noblesse/?page=profile&id=".$logado['id']);          
            }        
        }
    }