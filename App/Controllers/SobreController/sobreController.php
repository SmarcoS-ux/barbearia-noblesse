<?php
    class SobreController {
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('App/Views/SobrePage');
            $twig = new \Twig\Environment($loader);

            $template = $twig->load('sobre.html');
            $page = $template->render();

           /* echo "
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        themeToggle();
                    })
                </script>
            ";*/

            
            echo $page;
        }
    }