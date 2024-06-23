<?php
    class ProfileModel {
        private static $nome;
        private static $dt_nascimento;
        private static $email;
        private static $password_hash;
        private static $info;
        private static $img_profile;
        private static $id_agendamento;
        
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

        public static function setImgProfile($img_profile){
            self::$img_profile = $img_profile;
        }

        public static function setInfo($info){
            self::$info = $info;
        }

        public static function setIdAgendamento($id_ag){
            self::$id_agendamento = $id_ag; 
        }

        public static function userUpdate(){
            try {
                $sql = "update users set nome=:nome, dt_nascimento=:dt_nascimento, email=:email, password_hash=:password_hash, info=:info, img_profile=:img_profile where id=:id";

                Session::start_session();

                $statement = DB_Connection::getConnection()->prepare($sql);
                $statement->bindValue(":nome", self::$nome);
                $statement->bindValue(":dt_nascimento", self::$dt_nascimento);
                $statement->bindValue(":email", self::$email);
                $statement->bindValue(":password_hash", self::$password_hash);
                $statement->bindValue(":info", self::$info);
                $statement->bindValue(":img_profile", self::$img_profile);
                $statement->bindValue(":id", Session::getVariableSession('id'));
                $result = $statement->execute();

                if($result){
                    Session::start_session();
                    Session::setVariableSession('nome', self::$nome);
                    Session::setVariableSession('email', self::$email);
                    Session::setVariableSession('dt_nascimento', self::$dt_nascimento);
                    Session::setVariableSession('img_profile', self::$img_profile);

                    return 'success';

                } else{
                    return 'fail';
                }

            } catch(Exception $err){
                echo "Erro ao atualizar os dados do usuário. ".$err->getMessage();
                return 'fail';
            }
        }

        public static function getAgendamentos(){
            try {
                $sql = "select id, registro, data_agendamento, horario, dia_semana from agendamentos where id_user=:id_user";

                Session::start_session();

                $statement = DB_Connection::getConnection()->prepare($sql);
                $statement->bindValue(":id_user", Session::getVariableSession('id'));
                $statement->execute();

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                return $result;

            } catch(Exception $err){
                print_r("Erro ao buscar os agendamentos. ".$err->getMessage());
            }
        }

        public static function deleteAgendamento(){
            try {
                $sql = 'delete from agendamentos where id=:id_ag and id_user=:id_user';
                
                Session::start_session();

                $statement = DB_Connection::getConnection()->prepare($sql);
                $statement->bindValue("id_ag", self::$id_agendamento);
                $statement->bindValue("id_user", Session::getVariableSession('id'));
                $result = $statement->execute();

                /*if($result){
                    print_r("Agendamento deletado.");
                } else{
                    "Agendamento não deletado.";
                }*/

            } catch(Exception $err){
                echo "Erro ao Deletar um agendamento. ".$err->getMessage();
            }
        }
    }