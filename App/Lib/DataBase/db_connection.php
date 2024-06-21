<?php
    abstract class DB_Connection {
        private static $host = "localhost";
        private static $db_name = "barber_noblesse";
        private static $user = "root";
        private static $password = "";

        static public function getConnection(){
            try {
                $conn = new PDO("mysql:host=".self::$host.";dbname=".self::$db_name.";", self::$user, self::$password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $conn;

            } catch(Exception $err){
                //echo "Erro ao se conectar ao Banco de Dados! ".$err->getMessage();
                return 'erro';
            }          
        }
    }