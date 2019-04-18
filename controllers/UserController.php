<?php
namespace controllers;
use models\UserManager;
class UserController {
    public function register($pseudo, $password, $email) {
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password_confirm']) && !empty($_POST['email']))
            {
                $pseudoLength = strlen($pseudo);
                if ($pseudoLength <= 255)
                {
                    $newUserManager = new UserManager();
                    $newUserManager->checkUserPseudo($pseudo);
                    $checkedUserPseudo = $GLOBALS['checkedUserPseudo'];
                    if ($checkedUserPseudo == 0)
                    {
                        $newUserManager = new UserManager();
                        $newUserManager->checkUserEmail($email);
                        $checkedUserEmail = $GLOBALS['checkedUserEmail'];
                        if ($checkedUserEmail == 0)
                        {
                            if ($_POST['password'] == $_POST['password_confirm'])
                            {
                                $newUserManager->addUser($pseudo, $password, $email);
                                $message = "Votre compte a bien été crée ! <a href='?controller=UserController&action=loginAction'>Me connecter</a>";
                            }
                            else
                            {
                                $message = "Vos mots de passe sont différents";
                            }
                        }
                        else
                        {
                            $message = "Cette adresse email est déjà utilisée";
                        }
                    }
                    else
                    {
                        $message = "Ce pseudo est déjà pris !";
                    }
                }
                else
                {
                    $message = "Votre pseudo ne doit pas dépasser 255 caractères !";
                }
            }
            else
            {
                $message = "Tous les champs doivent être rempli !";
            }
        }
        // Vue requise
        require 'views/register.php';
    }
    public function login($pseudo, $password) {
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (!empty($_POST['pseudo']) && !empty($_POST['password']))
            {
                $newUserManager = new UserManager();
                $newUserManager->checkUserParams($_POST['pseudo']);
                $checkedUserParams = $GLOBALS['checkedUserParams'];
                $isPasswordCorrect = password_verify($_POST['password'], $checkedUserParams['password']);
                if ($isPasswordCorrect == true)
                {
                    $_SESSION['id'] = $checkedUserParams['id'];
                    $_SESSION['pseudo'] = $checkedUserParams['pseudo'];
                    $_SESSION['email'] = $checkedUserParams['email'];
                    header('Location: index.php');
                }
                else
                {
                    $message = "Vos identifiants ne sont pas bons !";
                }
            }
            else
            {
                $message = "Tous les champs doivent être rempli !";
            }
        }
        // Vue requise
        require 'views/login.php';
    }
}