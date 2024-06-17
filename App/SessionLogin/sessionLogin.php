<?php
    
    class Session {
        public static function start_session(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }          
        }

        public static function setVariableSession($name, $value){
            $_SESSION[$name] = $value;
        }

        public static function getVariableSession($name){
            return isset($_SESSION[$name]) ? $_SESSION[$name] : "Null";
        }

        public static function destroySession(){
            session_unset();
            session_destroy();
        }
    }
   