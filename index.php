<?php
namespace controllers;
session_start();
require 'vendor/autoload.php';
if(isset($_GET['controller']) && ($_GET['action'])) {
    if($_GET['controller'] == 'UserController' && $_GET['action'] == 'registerAction') {
        $pseudo = isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : NULL;
        $password_hash = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : NULL;
        $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : NULL;
        $newUserController = new UserController();
        $newUserController->register($pseudo, $password_hash, $email);
    }
    elseif($_GET['controller'] == 'UserController' && $_GET['action'] == 'loginAction') {
        $pseudo = isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : NULL;
        $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : NULL;
        $newUserController = new UserController();
        $newUserController->login($pseudo, $password);
    }
    elseif($_GET['controller'] == 'UserController' && $_GET['action'] == 'logoutAction') {
        require 'views/logout.php';
    }
}
else {
    require 'views/listPosts.php';
}