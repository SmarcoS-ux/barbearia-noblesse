<?php
    class ContatoController {
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/ContatoPage');
            $twig = new \Twig\Environment($loader);

            $template = $twig->load('contato.html');
            $page = $template->render();

            /*echo "
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        themeToggle();
                    })
                </script>
            ";*/

            echo $page;
        }
    }