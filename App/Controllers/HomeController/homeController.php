<?php
    class HomeController {
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/HomePage');
            $twig = new \Twig\Environment($loader);

            $dataHome = array();
            $dataHome['titulo'] = "Home";

            $template = $twig->load('home.html');
            $page = $template->render($dataHome);
            echo $page; 
        }
    } 
