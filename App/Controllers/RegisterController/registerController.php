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
            try {
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
    }