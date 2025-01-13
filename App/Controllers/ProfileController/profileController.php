<?php
    header('Access-Control-Allow-Origin: http://barber-noblesse.exaltaicifra.com.br/');
    header('Access-Control-Allow-Credentials: true');

    class ProfileController {
        private static $message;

        private static $firstLoad = true;
        public function index(){
            Session::start_session();

            $loader = new \Twig\Loader\FilesystemLoader('App/Views/ProfilePage');
            $twig = new \Twig\Environment($loader);

            $agendamentos = ProfileModel::getAgendamentos();
            /*if(empty($agendamentos)){
                self::$message = 'vazio';
            }*/

            if(Session::getVariableSession('isLogged') != "True"){
                header("location: http://localhost/barbearia-noblesse-local/?page=login");     
            } 
            
            $dataUser = array();
            $firstName = explode(" ", Session::getVariableSession('nome'));

            $dataUser['nome'] = Session::getVariableSession('nome');
            $dataUser['email'] = Session::getVariableSession('email');
            $dataUser['dt_nascimento'] = Session::getVariableSession('dt_nascimento');
            $dataUser['firstName'] = $firstName[0];
            $dataUser['message'] = self::$message;
            $dataUser['agendamentos'] = !empty($agendamentos) ? $agendamentos : 'vazio';
            $dataUser['img_profile'] = Session::getVariableSession('img_profile');

            $template = $twig->load('profile.html');
            $page = $template->render($dataUser); 
          

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
            Session::start_session();

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

            $old_img_profile = Session::getVariableSession('img_profile');
            $localIMGDefault = 'public/img/user.png';

            if(!empty($photo['name'])){
                if(file_exists($old_img_profile) && $old_img_profile != $localIMGDefault){
                    try {
                        unlink($old_img_profile);

                    } catch(Exception $err){
                        print_r("Erro ao tentar remover o arquivo do servidor. ".$err->getMessage());
                    }
                }

                move_uploaded_file($photo['tmp_name'], $dir_imgs."img_profile_id".$path.".jpeg");
 
            } else{
                $localDir = 'public/img/user.png';
            }

            //Dados do formulário de Update User
            $dadosProfile = $_POST;

            if(!empty($dadosProfile['nome']) && !empty($dadosProfile['email2']) && !empty($dadosProfile['dt_nascimento'])){
                ProfileModel::setNome($dadosProfile['nome']);
                ProfileModel::setEmail($dadosProfile['email2']);
                ProfileModel::setDtNascimento($dadosProfile['dt_nascimento']);
                ProfileModel::setInfo(isset($dadosProfile['check_info']) ? intval($dadosProfile['check_info']) : 0);
                ProfileModel::setPassword($dadosProfile['password2']);
                ProfileModel::setImgProfile($localDir);

                self::$message = ProfileModel::userUpdate();
            }

            $this->index();
        }

        public function logout(){
            Session::start_session();
            Session::destroySession();

            header('location: http://localhost/barbearia-noblesse-local/');        
        }

        public function deleteAgendamento(){
            Session::start_session();
            
            self::$firstLoad = false;
            
            $id = $_POST;
            
            if(Session::getVariableSession('isLogged') == 'True'){
                ProfileModel::setIdAgendamento($id['id_ag']);

                ProfileModel::deleteAgendamento();
            }

            $this->index();
        }
    }