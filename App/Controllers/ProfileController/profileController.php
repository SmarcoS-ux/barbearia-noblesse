<?php
    class ProfileController {
        private static $message;

        private static $firstLoad = true;
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/ProfilePage');
            $twig = new \Twig\Environment($loader);

            $agendamentos = ProfileModel::getAgendamentos();

            Session::start_session();
            $dataUser = array();
            $firstName = explode(" ", Session::getVariableSession('nome'));

            $dataUser['nome'] = Session::getVariableSession('nome');
            $dataUser['email'] = Session::getVariableSession('email');
            $dataUser['dt_nascimento'] = Session::getVariableSession('dt_nascimento');
            $dataUser['firstName'] = $firstName[0];
            $dataUser['message'] = self::$message;
            $dataUser['agendamentos'] = $agendamentos;
            $dataUser['img_profile'] = Session::getVariableSession('img_profile');

            $template = $twig->load('profile.html');
            $page = $template->render($dataUser);
          
            Session::start_session();
            if(Session::getVariableSession('isLogged') != "True"){
                header("location: http://localhost/Barbearia-Noblesse/?page=login");     
            } 

            if(self::$firstLoad === true){
                echo $page; 
            }
             
            if(self::$firstLoad === false){
                echo $page;
                echo "<script>
                        var table = document.getElementById('container-table');

                        if(table){
                            document.addEventListener('DOMContentLoaded', () => {
                                table.scrollIntoView({ behavior: 'smooth' });
                            }); 
                        }                           
                      </script>";
            }                               
        }


        public function updateUserData(){
            $photo = $_FILES['img-profile'];

            function codGenerator($tamanho){
                $caracter = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $qnt_caracter = strlen($caracter);

                $cod = '';

                for($i=0; $i<$tamanho; $i++){
                    $id_aleatorio = random_int(0, $qnt_caracter -1);
                    $cod .= $caracter[$id_aleatorio];
                }

                return $cod;
            }

            $dir_imgs = "public/img/img_users/";

            $path = codGenerator(10);
            $localDir = 'public/img/img_users/img_profile_id'.$path.'.jpeg';
            
            if(!empty($photo['name'])){
                move_uploaded_file($photo['tmp_name'], $dir_imgs."img_profile_id".$path.".jpeg");
                //echo 'upload success';
            } else{
                $localDir = 'public/img/user.png';
            }


            $dadosProfile = $_POST;

            if(!empty($dadosProfile['nome']) && !empty($dadosProfile['email2']) && !empty($dadosProfile['dt_nascimento'])){
                ProfileModel::setNome($dadosProfile['nome']);
                ProfileModel::setEmail($dadosProfile['email2']);
                ProfileModel::setDtNascimento($dadosProfile['dt_nascimento']);
                ProfileModel::setInfo(isset($dadosProfile['check_info']) ? $dadosProfile['check_info'] : 0);
                ProfileModel::setPassword($dadosProfile['password2']);
                ProfileModel::setImgProfile($localDir);

                self::$message = ProfileModel::userUpdate();
            }

            $this->index();
        }

        public function logout(){
            Session::start_session();
            Session::destroySession();

            header('location: http://localhost/Barbearia-Noblesse/');        
        }

        public function deleteAgendamento(){
            self::$firstLoad = false;
            
            $id = $_POST;
            
            Session::start_session();
            if(Session::getVariableSession('isLogged') == 'True'){
                ProfileModel::setIdAgendamento($id['id_ag']);

                ProfileModel::deleteAgendamento();
            }

            $this->index();
        }
    }