<?php
    class HomeModel {
        private static $data;
        private static $horario;
        private static $observacoes;


        public static function setData($data){
            self::$data = $data;
        }
        public static function sethorario($horario){
            self::$horario = $horario;
        }
        public static function setObservacoes($observacoes){
            self::$observacoes = $observacoes;
        }

        public static function verificarDisponibilidade(){
            try {
                $sql = "select data_agendamento, horario from agendamentos";

                $statement = DB_Connection::getConnection()->prepare($sql);
                $statement->execute();

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                $indisponivel = false;
                foreach($result as $obj){
                    if($obj['data_agendamento'] == self::$data && $obj['horario'] == self::$horario){
                        $indisponivel = true;
                    }
                }

                if(!$indisponivel){
                    return 'disponivel';

                } else {
                    return 'indisponivel';
                }

            } catch(Exception $err){
                echo "Erro ao verificar a Disponibilidade. ".$err->getMessage();
            }
        }
    }