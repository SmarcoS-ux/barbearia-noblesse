<?php
    class ProfileController {
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/ProfilePage');
            $twig = new \Twig\Environment($loader);


            $template = $twig->load('profile.html');
            $page = $template->render();
            echo $page; 
        }
    }