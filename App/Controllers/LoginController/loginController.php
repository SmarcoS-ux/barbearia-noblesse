<?php
    class LoginController {
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/LoginPage');
            $twig = new \Twig\Environment($loader);

            $template = $twig->load('login.html');
            $page = $template->render();
            echo $page; 
        }
    }