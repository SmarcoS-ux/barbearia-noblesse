<?php
    class ErroController {
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/ErroPage');
            $twig = new \Twig\Environment($loader);

            $template = $twig->load('erro.html');
            $page = $template->render();
            echo $page;
        }
    }