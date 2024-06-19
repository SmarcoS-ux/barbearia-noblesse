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
                if(DB_Connection::getConnection() == 'erro'){
                    throw new Exception("Erro na conexão com a Base de Dados.");
                }

                $sql = "select data_agendamento, horario from agendamentos";

                $statement = DB_Connection::getConnection()->prepare($sql);
                $statement->execute();

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                $indisponivel = 'false';
                if(!empty(self::$data) && !empty(self::$horario)){
                    //print_r("Não está vazio");
                    foreach($result as $obj){
                        if($obj['data_agendamento'] == self::$data && $obj['horario'] == self::$horario){
                            $indisponivel = 'true';
                        }
                    }
                } else{
                    //print_r("Está vazio");
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
    }