<?php
require_once('/xampp/htdocs/argon/view/pages/user/User.class.php');

session_start();

if(isset($_POST['login'])){
    $user = new User();
   
    $email = $_POST['emailUser'];
    $password = $_POST['passwordUser'];
    

    if($user->logar($email, $password) == true){
        
        header('Location: ../../../dashboard.php');

    } else{
        $_SESSION['statusNegative'] = "Usuário não existe, faça o cadastro.";
        header('Location: ../../../index.php');
    }
}