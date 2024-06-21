<?php
    class ProfileController {
        private static $message;
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/ProfilePage');
            $twig = new \Twig\Environment($loader);

            $agendamentos = ProfileModel::getAgendamentos();
            //print_r($agendamentos);

            Session::start_session();
            $dataUser = array();
            $firstName = explode(" ", Session::getVariableSession('nome'));

            $dataUser['nome'] = Session::getVariableSession('nome');
            $dataUser['email'] = Session::getVariableSession('email');
            $dataUser['dt_nascimento'] = Session::getVariableSession('dt_nascimento');
            $dataUser['firstName'] = $firstName[0];
            $dataUser['message'] = self::$message;
            $dataUser['agendamentos'] = $agendamentos;

            $template = $twig->load('profile.html');
            $page = $template->render($dataUser);
          
            Session::start_session();
            if(Session::getVariableSession('isLogged') != "True"){
                header("location: http://localhost/Barbearia-Noblesse/?page=login");     
            } 

            echo $page;                      
        }


        public function updateUserData(){
            $dadosProfile = $_POST;

            if(!empty($dadosProfile['nome']) && !empty($dadosProfile['email2']) && !empty($dadosProfile['dt_nascimento'])){
                ProfileModel::setNome($dadosProfile['nome']);
                ProfileModel::setEmail($dadosProfile['email2']);
                ProfileModel::setDtNascimento($dadosProfile['dt_nascimento']);
                ProfileModel::setInfo(isset($dadosProfile['check_info']) ? $dadosProfile['check_info'] : 0);
                ProfileModel::setPassword($dadosProfile['password2']);

                self::$message = ProfileModel::userUpdate();
            }

            $this->index();
        }

        public function logout(){
            Session::start_session();
            Session::destroySession();

            header('location: http://localhost/Barbearia-Noblesse/');        
        }
    }