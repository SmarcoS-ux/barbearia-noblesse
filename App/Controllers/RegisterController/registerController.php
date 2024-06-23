<?php
    class RegisterController {
        public function index($params = null){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/RegisterPage');
            $twig = new \Twig\Environment($loader);

            $objectData = array();
            $objectData['registerSuccess'] = $params;

            $template = $twig->load('register.html');
            $page = $template->render($objectData);
            echo $page; 
        }

        public function registerUserForm(){
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

            try {
                $photo = $_FILES['img-profile']; 
                //print_r($photo);

                $dir_imgs = "public/img/img_users/";

                $path = codGenerator(10);
                $localDir = 'public/img/img_users/img_profile_id'.$path.'.jpeg';
                
                if(!empty($photo['name'])){                
                    move_uploaded_file($photo['tmp_name'], $dir_imgs."img_profile_id".$path.".jpeg");
                    //echo 'upload success';
                       
                } else{
                    $localDir = 'public/img/user.png';
                }

                $dados = $_POST;

                if($dados != null && $dados !== ""){
                    $nome = $dados['nome'];
                    $dt_nascimento = $dados['dt-nascimento'];
                    $email1 = $dados['email1'];
                    $emailConfirm = $dados['email2'];
                    $password1 = $dados['password1'];
                    $passwordConfirm = $dados['password2'];
                    $info = (isset($dados['info'])) ? intval($dados['info']) : 0;

                    RegisterModel::setNome($nome);
                    RegisterModel::setDtNascimento($dt_nascimento);
                    
                    if($email1 == $emailConfirm){
                        RegisterModel::setEmail($emailConfirm);
                    }

                    if($password1 == $passwordConfirm){
                        $password_hash = password_hash($passwordConfirm, PASSWORD_DEFAULT, array());
                        RegisterModel::setPasswordHash($password_hash);
                    }

                    RegisterModel::setInfo($info);
                    RegisterModel::setImgProfile($localDir);

                    $register = RegisterModel::registerUser();
                    //echo $register;

                    $this->index($register);

                    switch($register){
                        case 'Success':
                            $time = 3;
                            header("Refresh: $time, url='http://localhost/Barbearia-Noblesse/?page=login'");
                            
                    }
                }
            
            } catch(Exception $err){
                echo "Erro ao cadastrar os Dados. ".$err->getMessage();
            }        
        }

        public function uploadIMGProfile(){
            $photo = $_FILES;

            print_r($photo);
            print_r("Teste");
        }
    }