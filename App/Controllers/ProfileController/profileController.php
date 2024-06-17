<?php
    class ProfileController {
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/ProfilePage');
            $twig = new \Twig\Environment($loader);

            Session::start_session();
            $dataUser = array();
            $firstName = explode(" ", Session::getVariableSession('nome'));

            $dataUser['nome'] = Session::getVariableSession('nome');
            $dataUser['email'] = Session::getVariableSession('email');
            $dataUser['dt_nascimento'] = Session::getVariableSession('dt_nascimento');
            $dataUser['firstName'] = $firstName[0];


            $template = $twig->load('profile.html');
            $page = $template->render($dataUser);
          
            Session::start_session();
            if(Session::getVariableSession('isLogged') != "True"){
                header("location: http://localhost/Barbearia-Noblesse/?page=login");     
            } 
           
            echo $page;                      
        }


        public function getUserData(){

        }
    }