<?php
    class HomeModel {
        private static $data;
        private static $data_atual;
        private static $horario;
        private static $observacoes;


        public static function setData($data){
            self::$data = $data;
        }
        public static function setDataAtual($data_atual){
            self::$data_atual = $data_atual;
        }
        public static function sethorario($horario){
            self::$horario = $horario;
        }
        public static function setObservacoes($observacoes){
            self::$observacoes = $observacoes;
        }

        public static function verificarDisponibilidade(){
            try {
                if(DB_Connection::getConnection() == 'erro'){
                    throw new Exception("Erro na conexão com a Base de Dados.");
                }

                $sql = "select data_agendamento, horario from agendamentos";

                $statement = DB_Connection::getConnection()->prepare($sql);
                $statement->execute();

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                $indisponivel = 'false';
                if(!empty(self::$data) && !empty(self::$horario)){
                    foreach($result as $obj){
                        if($obj['data_agendamento'] == self::$data && $obj['horario'] == self::$horario){
                            $indisponivel = 'true';
                        }
                    }
                } else{
                    $indisponivel = '';
                }
                
                switch($indisponivel){
                    case '':
                        return 'vazio';

                    case 'true':
                        return 'indisponivel';
                        
                    case 'false':
                        return 'disponivel';

                }
            } catch(Exception $err){
                //echo "Erro ao verificar a Disponibilidade. ".$err->getMessage();
                return 'erro';
            }
        }

        public static function registerAgendamento(){
            try {
                $sql = 'insert into agendamentos (id_user, registro, data_agendamento, horario, observacoes)
                        values (:id_user, :registro, :data_agendamento, :horario, :observacoes)';

                Session::start_session();        

                $statement = DB_Connection::getConnection()->prepare($sql);
                $statement->bindValue(":id_user", Session::getVariableSession('id'));
                $statement->bindValue(":registro", self::$data_atual);
                $statement->bindValue(":data_agendamento", self::$data);
                $statement->bindValue(":horario", self::$horario);
                $statement->bindValue(":observacoes", self::$observacoes);
                $result = $statement->execute();

                print_r($result);

                if($result){
                    return 'agendado';

                } else{
                    return 'erro';
                }

            } catch(Exception $err){
                echo "Erro ao registrar o agendamento. ".$err->getMessage();
            }
        }
    }