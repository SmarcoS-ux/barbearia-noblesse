<?php
    class CortesController {
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/CortesPage');
            $twig = new \Twig\Environment($loader);


            $template = $twig->load('cortes.html');
            $page = $template->render();
            echo $page; 
        }
    }