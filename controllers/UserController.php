<?php
namespace controllers;
use models\UserManager;
class UserController {

    /* Je crée une fonction public que j'appelle register. Cette fonction servira a l'enregistrement d'un utilisateur. 
    Je commence par définir grâce a la variable $message un message qui pour le moment est vide.
    Si la requête que l'on envoi au serveur est une requête POST
    Si le pseudo n'est pas vide, et le password n'est pas vide, et la confirmation du password n'est pas vide et l'email n'est pas vide */

    public function register($pseudo, $password, $email) {
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password_confirm']) && !empty($_POST['email']))
            {

                /* On dit $pseudoLength est égale a la longeur de notre pseudo
                Si notre pseudo est inférieur ou égale a 255 caractères 
                On dit ensuite que $newUserManager est une nouvelle instance de UserManager grâce au mot clé new
                On s'occupe ensuite de savoir si notre pseudo est déjà utlisé grâce a notre superglobal $GLOBALS 
                Ensuite on dit que si $checkedUserPseudo est égale a 0*/

                $pseudoLength = strlen($pseudo);
                if ($pseudoLength <= 255)
                {
                    $newUserManager = new UserManager();
                    $newUserManager->checkUserPseudo($pseudo);
                    $checkedUserPseudo = $GLOBALS['checkedUserPseudo'];
                    if ($checkedUserPseudo == 0)
                    {

                        /* On crée encore une nouvelle instance de UserManager grâce au mot clé new
                        On appelle ensuite la méthode checkUserEmail dans laquel on passe en paramètre l'email de l'utilisateur
                        On vérifie ensuite que notre email n'est pas déjà utilisé 
                        Si checkedUserEmail est égal a 0 */
                        
                        $newUserManager = new UserManager();
                        $newUserManager->checkUserEmail($email);
                        $checkedUserEmail = $GLOBALS['checkedUserEmail'];
                        if ($checkedUserEmail == 0)
                        {

                            /* Si notre mot de passe est égal a notre mot de passe entré dans la case confirmation 
                            On execute la méthode addUser qui va ce charger d'entrer nos valeurs dans la base de données 
                            Notre message que nous avons crée vide nous informe que le compte a bien été crée*/

                            if ($_POST['password'] == $_POST['password_confirm'])
                            {
                                $newUserManager->addUser($pseudo, $password, $email);
                                $message = "Votre compte a bien été crée ! <a href='?controller=UserController&action=loginAction'>Me connecter</a>";
                            }

                            /* Sinon, on affiche que nos mots de passe ne coresspondent pas */

                            else
                            {
                                $message = "Vos mots de passe sont différents";
                            }
                        }

                        /* Sinon on annonce que l'adresse mail est déjà utilisée */

                        else
                        {
                            $message = "Cette adresse email est déjà utilisée";
                        }
                    }

                    /* Sinon on annonce que le pseudo est déjà pris */

                    else
                    {
                        $message = "Ce pseudo est déjà pris !";
                    }
                }

                /* Sinon on annonce que le pseudo ne doit pas dépasser 255 caractères */

                else
                {
                    $message = "Votre pseudo ne doit pas dépasser 255 caractères !";
                }
            }

            /* Sinon on annonce que le que tous les champs doivent être rempli */

            else
            {
                $message = "Tous les champs doivent être rempli !";
            }
        }
        
        /* On ajoute la vue du register.php */

        require 'views/register.php';
    }

    /* On crée une fonction qui va nous permettre la connexion de l'utilisateur
    On recommence comme tout a l'heure par définir un message vide
    Si la méthode utilisé par le serveur est une requête POST
    Si la case du pseudo et la case du password ne sont pas vide */

    public function login($pseudo, $password) {
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (!empty($_POST['pseudo']) && !empty($_POST['password']))
            {

                /* On crée une nouvelle instance de UserManager
                On execute la méthode checkUserParams avec le pseudo que l'on a envoyé en requête POST
                On dit ensuite que que checkedUserParams est égale a la superglobal checkedUserParams
                On crée ensuite une variable isPasswordCorrect qui va vérifier si le mot de passe correspond au nom d'utilisateur.
                Si isPassword est true */

                $newUserManager = new UserManager();
                $newUserManager->checkUserParams($_POST['pseudo']);
                $checkedUserParams = $GLOBALS['checkedUserParams'];
                $isPasswordCorrect = password_verify($_POST['password'], $checkedUserParams['password']);
                if ($isPasswordCorrect == true)
                {

                    /* Notre ID de la session sera égale a l'id de l'utilisateur
                    Notre pseudo de la session sera égale au pseudo de l'utilisateur
                    L'email de la session sera égale a l'email de l'utilisateur
                    On redirige vers l'index */

                    $_SESSION['id'] = $checkedUserParams['id'];
                    $_SESSION['pseudo'] = $checkedUserParams['pseudo'];
                    $_SESSION['email'] = $checkedUserParams['email'];
                    header('Location: index.php');
                }

                /* Sinon on renvoi un message qui nous indique que nos identifiants ne sont pas bon */

                else
                {
                    $message = "Vos identifiants ne sont pas bons !";
                }
            }

            /* Sinon on renvoi un message qui nous indique que tout les champs doivent être rempli */

            else
            {
                $message = "Tous les champs doivent être rempli !";
            }
        }

        /* On insère la vue du login */
        
        require 'views/login.php';
    }
}