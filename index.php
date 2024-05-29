<?php
    require_once("App/Controllers/HomeController/homeController.php");
    require_once("App/Controllers/ErroController/erroController.php");

    require_once("App/Core/core.php");

    require_once("vendor/autoload.php");


    $startApp = new Core();
    $startApp->start($_GET); 