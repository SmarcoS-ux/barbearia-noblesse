<?php
    class HomeController {
        private static $firstLoad = true;
        private static $isAvailableTime;
        private static $dadosDigitados;

        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/HomePage');
            $twig = new \Twig\Environment($loader);

            $dataHome = array();
            $dataHome['titulo'] = "Home";
            $dataHome['message'] = self::$isAvailableTime;
            $dataHome['data'] = isset(self::$dadosDigitados['data']) ? self::$dadosDigitados['data'] : "";
            $dataHome['horarios'] = isset(self::$dadosDigitados['select-horarios']) ? self::$dadosDigitados['select-horarios'] : "";
            $dataHome['diaSemana'] = isset(self::$dadosDigitados['dia-semana']) ? self::$dadosDigitados['dia-semana'] : "";
            
            $template = $twig->load('home.html');
            $page = $template->render($dataHome);

            //print_r(self::$dadosDigitados);

            if(self::$firstLoad){
                echo $page; 

            } else {
                echo $page;
                echo "<script>
                        document.addEventListener('DOMContentLoaded', () => {
                            var section = 'reserva-horarios';
                            if(section){
                                document.getElementById(section).scrollIntoView();
                            }
                        })
                      </script>";
            }
            
        }

        public function submitFormVerifyAg(){
            $dadosAgendamento = $_POST;

            //print_r($dadosAgendamento);

            self::$dadosDigitados = $dadosAgendamento;

            HomeModel::setData($dadosAgendamento['data']);
            HomeModel::sethorario(substr($dadosAgendamento['select-horarios'], 0, 5));

            self::$isAvailableTime = HomeModel::verificarDisponibilidade();
    
            self::$firstLoad = false;

            $this->index();  
        }
    } 
