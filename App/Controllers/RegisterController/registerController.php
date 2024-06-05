<?php
    class RegisterController {
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/RegisterPage');
            $twig = new \Twig\Environment($loader);

            $template = $twig->load('register.html');
            $page = $template->render();
            echo $page; 
        }
    }