<?php
    header('Access-Control-Allow-Origin: http://barber-noblesse.exaltaicifra.com.br/');
    header('Access-Control-Allow-Credentials: true');

    class LoginController {
        private static $isLogged = "";

        public function index($params = null){
            Session::start_session();

            //test
            //print_r($_SESSION);

            $loader = new \Twig\Loader\FilesystemLoader('App/Views/LoginPage');
            $twig = new \Twig\Environment($loader);

            $paramss = array();
            $paramss['logado'] = self::$isLogged;
            $template = $twig->load('login.html');
            $page = $template->render($paramss);

            
            //test
            //print_r("Variável de sessão: " . Session::getVariableSession('isLogged'));

            if(Session::getVariableSession('isLogged') == "True"){
                $time = 0;
                $logado = LoginModel::authenticationUser();
                header("location: http://localhost/barbearia-noblesse-local/?page=profile");
            } 

            echo $page;
        }

        /*public static function getIsLogged(){
            return self::$isLogged;
        }

        private static function setIsLogged($params){
            self::$isLogged = $params;
        }*/

        public function verifyUser(){
            Session::start_session();
            
            $dados = $_POST;

            $email = $dados['email'];
            $password = $dados['password'];

            LoginModel::setEmail($email);
            LoginModel::setPasswordHash($password);

            $logado = LoginModel::authenticationUser();
            //print_r($logado);

            self::$isLogged = $logado['return'];

            $this->index();
           
            if(Session::getVariableSession('isLogged') == "True"){
                $time = 1;
                header("refresh: $time, url=http://localhost/barbearia-noblesse-local/?page=profile");          
            } 

        }
    }