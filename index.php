<?php
    include_once("App/Controllers/HomeController/homeController.php");
    include_once("App/Controllers/ErroController/erroController.php");
    include_once("App/Controllers/SobreController/sobreController.php");
    include_once("App/Controllers/ContatoController/contatoController.php");
    include_once("App/Controllers/CortesController/cortesController.php");
    include_once("App/Controllers/LoginController/loginController.php");
    include_once("App/Controllers/RegisterController/registerController.php");

    include_once("App/Core/core.php");

    require_once('vendor/autoload.php');

    $structure_pages = file_get_contents('App/Views/StructurePages/structurePages.html');

    ob_start();
        $startApp = new Core();
        $startApp->start($_GET);

        $dataReturned = ob_get_contents();
    ob_end_clean();

    $title_page = null;
    if(isset($_GET['page'])){
        $title_page = ucfirst($_GET['page']);
    } else{
        $title_page = "Home";
    }

    $page_dinamic = str_replace('{{titulo_document}}', $title_page, $structure_pages);
    $page_dinamic = str_replace('{{content_dinamic}}', $dataReturned, $page_dinamic);
    echo $page_dinamic;