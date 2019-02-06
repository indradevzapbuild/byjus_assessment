<?php
    error_reporting(-1);
    ini_set('display_errors', 'On');

    $_SERVER['DOCUMENT_ROOT'] = __DIR__;
    $_SERVER['APP_ROOT'] = "/";
     require($_SERVER['DOCUMENT_ROOT'] . $_SERVER['APP_ROOT'] . 'config/config.php'); //
    require($_SERVER['DOCUMENT_ROOT'] . $_SERVER['APP_ROOT'] . 'models/DbConfig.php'); //
    require($_SERVER['DOCUMENT_ROOT'] . $_SERVER['APP_ROOT'] . 'models/UserModel.php'); //
    require($_SERVER['DOCUMENT_ROOT'] . $_SERVER['APP_ROOT'] . 'models/BasicInfo.php'); //
    require($_SERVER['DOCUMENT_ROOT'] . $_SERVER['APP_ROOT'] . 'models/CollegeModel.php'); //
    //end auto loader


 ?>