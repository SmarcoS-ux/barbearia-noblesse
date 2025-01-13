<?php
    header('Access-Control-Allow-Origin: http://barber-noblesse.exaltaicifra.com.br/');
    header('Access-Control-Allow-Credentials: true');

    class LoginModel {
        private static $email;
        private static $password;

        public static function setEmail($email){
            self::$email = $email;
        }

        public static function setPasswordHash($password){
            self::$password = $password;
        }

        public static function authenticationUser(){
            Session::start_session();
            
            try {   
                if(DB_connection::getConnection() == 'erro'){
                    throw new Exception("Erro na conexão com a Base de Dados.");
                }

                $sql = "select email, password_hash from users";

                $statement = DB_Connection::getConnection()->prepare($sql);
                $statement->execute();

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                //print_r($result[0]);

                $isLoggedIn = false;
                for($i=0; $i<count($result); $i++){
                    if($result[$i]['email'] == self::$email && password_verify(self::$password, $result[$i]['password_hash'])){
                        $isLoggedIn = true;
                        break;
                    } 
                }

                if($isLoggedIn){
                    $sql = 'select id, nome, dt_nascimento, email, img_profile from users where email = :email';

                    $statement = DB_Connection::getConnection()->prepare($sql);
                    $statement->bindValue(":email", self::$email);
                    $statement->execute();

                    $result2 = $statement->fetchAll(PDO::FETCH_ASSOC);

                    //print_r($result2);
                  
                    Session::setVariableSession('isLogged', 'True');
                    Session::setVariableSession('id', $result2[0]['id']);
                    Session::setVariableSession('nome', $result2[0]['nome']);
                    Session::setVariableSession('email', $result2[0]['email']);
                    Session::setVariableSession('dt_nascimento', $result2[0]['dt_nascimento']);
                    Session::setVariableSession('img_profile', $result2[0]['img_profile']);
                   

                    /*$logged =  Session::getVariableSession("isLogged");
                    echo $logged;
                    echo $result2[0]['id'];*/

                    return array(
                        "id" => $result2[0]['id'], 
                        "return" => "Logado"
                    ); 
                    
                
                } else {
                    //$_SESSION['isLogged'] = false;

                    return array(
                        "id" => null, 
                        "return" => "NaoLogado"
                    );
                }
            } catch(Exception $err){
                //print_r("Erro ao realizar o Login. ".$err->getMessage());
                //$_SESSION['isLogged'] = false;

                return array(
                    "id" => null, 
                    "return" => "ErroLogin"
                );
            }    
        }
    }