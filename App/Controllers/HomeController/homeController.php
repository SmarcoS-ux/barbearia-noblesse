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

            //date_default_timezone_set('America/Sao_Paulo');
            $timestamp = strtotime($dadosAgendamento['data'].substr($dadosAgendamento['select-horarios'], 0, 5));
            $date = getDate($timestamp);
            $dayWeek = $date['wday'];

            $data_atual = new DateTime();
            $fuso = new DateTimeZone('America/Sao_Paulo');
            $data_atual->setTimezone($fuso);
            $timestamp_atual = $data_atual->getTimestamp();

            $data_informada_formatada = new DateTime($dadosAgendamento['data']); 

            if(!empty($dadosAgendamento['data']) && !empty($dadosAgendamento['select-horarios']) && $dayWeek != 0){
                if($timestamp >= $timestamp_atual){
                    HomeModel::setData($data_informada_formatada->format("d/m/Y"));
                    HomeModel::sethorario(substr($dadosAgendamento['select-horarios'], 0, 5));

                    self::$message = HomeModel::verificarDisponibilidade();

                } else{
                    self::$message = 'invalidDate';
                }
                
            } else{
                self::$message = 'vazio';
            }
           

            if($dayWeek == 0){
                self::$message = "";
            }
 
            $this->index();  
        }

        public function registerAg(){
            self::$firstLoad = false; 

            $dadosAgendamento = $_POST;

            Session::start_session();
            if(Session::getVariableSession('isLogged') == 'True'){
                $timestamp = strtotime($dadosAgendamento['data'].substr($dadosAgendamento['select-horarios'], 0, 5));
                $date = getDate($timestamp);
                $dayWeek = $date['wday'];

                $dia_semana = "";

                switch($dayWeek){
                    case 0:
                        $dia_semana = 'Domingo';
                        break;
                    
                    case 1:
                        $dia_semana = 'Segunda-Feira';
                        break;

                    case 2:
                        $dia_semana = 'Terça-Feira';
                        break;

                    case 3:
                        $dia_semana = 'Quarta-Feira';
                        break;

                    case 4:
                        $dia_semana = 'Quinta-Feira'; 
                        break;

                    case 5:
                        $dia_semana = 'Sexta-Feira';
                        break;

                    case 6:
                        $dia_semana = 'Sábado';
                        break;

                    default:
                        $dia_semana = null;
                }

                $data_atual = new DateTime();
                $fuso = new DateTimeZone('America/Sao_Paulo');
                $data_atual->setTimezone($fuso);
                $timestamp_atual = $data_atual->getTimestamp();

                $data_agendamento = new DateTime($dadosAgendamento['data'].substr($dadosAgendamento['select-horarios'], 0, 5));
                $data_agendamento->setTimezone($fuso);
                $dt_agendamento = $data_agendamento->format("d/m/Y");


                if(!empty($dadosAgendamento['data']) && !empty($dadosAgendamento['select-horarios']) && $dayWeek != 0){
                    if($timestamp >= $timestamp_atual){
                        HomeModel::setData($dt_agendamento);
                        HomeModel::setDataAtual($data_atual->format("d/m/Y - H:i"));
                        HomeModel::sethorario(substr($dadosAgendamento['select-horarios'], 0, 5));
                        HomeModel::setDiaSemana($dia_semana);  
                        HomeModel::setObservacoes($dadosAgendamento['observacao']);

                        self::$message = HomeModel::registerAgendamento();

                    } else{
                        self::$message = 'invalidDate';
                    }
                    
                } else{
                    self::$message = 'vazio';
                }

                if($dayWeek == 0){
                    self::$message = "";
                }

            } else{
                self::$message = 'naoLogado';
            }

            $this->index();
        }


        public function goAgendamento(){
            self::$firstLoad = false;

            $this->index();
        }
    } 
