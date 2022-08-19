<?php
// header('Location: ../../../index.html');
require_once('/xampp/htdocs/argon/view/pages/user/User.class.php');

session_start();

if (isset($_POST['register'])) {

    if (!empty($_POST['passwordUser']) && !empty($_POST['confirmPasswordUser'])) {
        $password = $_POST['passwordUser'];
        $confirmPassword = $_POST['confirmPasswordUser'];

        if ($password != $confirmPassword) {
            $_SESSION['statusNegative'] = "Senhas não coincidem. Tente novamente.";
            header('Location: ../../../register.php');
        } else {
            $user = new User();

            $user->setName($_POST['nameUser']);
            $user->setEmail($_POST['emailUser']);
            $user->setPassword(password_hash($_POST['passwordUser'], PASSWORD_DEFAULT));
            $user->registerUser($user);
        }
    }
}
