<?php
session_start();
require_once '/xampp/htdocs/argon/view/pages/user/User.class.php';

if(!isset($_SESSION['idAdm'])){

    unset($_SESSION['idAdm']);
    session_destroy();
    header('Location: ../../../index.php');
} 

