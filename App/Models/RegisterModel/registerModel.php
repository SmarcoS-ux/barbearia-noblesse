<?php

    class RegisterModel {
        private static $nome;
        private static $dt_nascimento;
        private static $email;
        private static $password_hash;
        private static $info;

        public static function setNome($nome){
            self::$nome = $nome;
        }

        public static function setDtNascimento($dt_nascimento){
            self::$dt_nascimento = $dt_nascimento;
        }

        public static function setEmail($email){
            self::$email = $email;
        }

        public static function setPasswordHash($password_hash){
            self::$password_hash = $password_hash;
        }

        public static function setInfo($info){
            self::$info = $info;
        }

        static public function registerUser(){
            try {
                $sql1 = "select email from users";

                $statement1 = DB_Connection::getConnection()->prepare($sql1);
                $statement1->execute();

                $resultEmails = $statement1->fetchAll(PDO::FETCH_ASSOC);

                $isRegistered = false;
                for($i=0; $i<count($resultEmails); $i++){
                    if($resultEmails[$i]['email'] == self::$email){
                        $isRegistered = true;
                        break;
                    }
                }

                if(!$isRegistered){
                    $sql2 = "insert into users (nome, dt_nascimento, email, password_hash, info) values (:nome, :dt_nascimento, :email, :password_hash, :info)";
            
                    $statement2 = DB_Connection::getConnection()->prepare($sql2);
                    $statement2->bindValue(":nome", self::$nome);
                    $statement2->bindValue(":dt_nascimento", self::$dt_nascimento);
                    $statement2->bindValue(":email", self::$email);
                    $statement2->bindValue(":password_hash", self::$password_hash);
                    $statement2->bindValue(":info", self::$info);
                    $statement2->execute();

                    return "Success";

                } else{
                    return "RegisteredEmail";
                }

            } catch(Exception $err){
                //echo "Erro ao inserir Dados na Base de Dados! ".$err->getMessage();
                return "Failed";
            }         
        }
    }