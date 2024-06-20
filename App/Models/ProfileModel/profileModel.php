<?php
    class ProfileModel {
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

        public static function setPassword($password){
            self::$password_hash = password_hash($password, PASSWORD_DEFAULT, array());
        }

        public static function setInfo($info){
            self::$info = $info;
        }

        public static function userUpdate(){
            try {
                $sql = "update users set nome=:nome, dt_nascimento=:dt_nascimento, email=:email, password_hash=:password_hash, info=:info where id=:id";

                Session::start_session();

                $statement = DB_Connection::getConnection()->prepare($sql);
                $statement->bindValue(":nome", self::$nome);
                $statement->bindValue(":dt_nascimento", self::$dt_nascimento);
                $statement->bindValue(":email", self::$email);
                $statement->bindValue(":password_hash", self::$password_hash);
                $statement->bindValue(":info", self::$info);
                $statement->bindValue(":id", Session::getVariableSession('id'));
                $result = $statement->execute();

                if($result){
                    Session::start_session();
                    Session::setVariableSession('nome', self::$nome);
                    Session::setVariableSession('email', self::$email);
                    Session::setVariableSession('dt_nascimento', self::$dt_nascimento);

                    return 'success';

                } else{
                    return 'fail';
                }

            } catch(Exception $err){
                //echo "Erro ao atualizar os dados do usuário. ".$err->getMessage();
                return 'fail';
            }
        }
    }