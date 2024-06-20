<?php
    class HomeController {
        private static $firstLoad = true;
        private static $message;
        private static $dadosDigitados;

        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/HomePage');
            $twig = new \Twig\Environment($loader);

            $dataHome = array();
            $dataHome['titulo'] = "Home";
            $dataHome['message'] = self::$message;
            $dataHome['data'] = isset(self::$dadosDigitados['data']) ? self::$dadosDigitados['data'] : "";
            $dataHome['horarios'] = isset(self::$dadosDigitados['select-horarios']) ? self::$dadosDigitados['select-horarios'] : "";
            $dataHome['diaSemana'] = isset(self::$dadosDigitados['dia-semana']) ? self::$dadosDigitados['dia-semana'] : "";
            
            $template = $twig->load('home.html');
            $page = $template->render($dataHome);

            //print_r(self::$dadosDigitados);

            if(self::$firstLoad === true){
                echo $page; 
            } 
            
            if(self::$firstLoad === false){
                echo $page;

                echo "<script>
                        var element = document.getElementById('reserva-horarios');
                        if(element){
                            document.addEventListener('DOMContentLoaded', () => {
                                element.scrollIntoView({ behavior: 'smooth' });                        
                            });
                        }
                      </script>";
            }          
        }

        public function submitFormVerifyAg(){
            self::$firstLoad = false;

            $dadosAgendamento = $_POST;

            self::$dadosDigitados = $dadosAgendamento;

            $timestamp = strtotime($dadosAgendamento['data']);
            $date = getDate($timestamp);
            $dayWeek = $date['wday'];


            if(!empty($dadosAgendamento['data']) && !empty($dadosAgendamento['select-horarios']) && $dayWeek != 0){
                HomeModel::setData($dadosAgendamento['data']);
                HomeModel::sethorario(substr($dadosAgendamento['select-horarios'], 0, 5));
            }

            self::$message = HomeModel::verificarDisponibilidade();
            if($dayWeek == 0){
                self::$message = "";
            }

    
            $this->index();  
        }
    } 
