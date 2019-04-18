<?php
namespace models;

/* Je crée une nouvelle class UserManager qui va me permettre de gérer mes utilisateurs. J'ajoute extends Manager pour dire que cette class
"UserManager" héritera de la class Manager qui ce trouve dans le fichier Manager.php. Le principe d'héritage est utile pour ne pas avoir des 
fichiers interminable */

class UserManager extends Manager {

    /* Je commence par crée une fonction public addUser dans laquel je passe en paramètre $pseudo $password et $email. Cette fonction me permettera de 
    crée un utilisateur.
    Je crée pour commencer une connexion a la base de données grâce a $db que je vais chercher dans Manager grâce a l'héritage.
    je crée une variable $request ou j'y insère une requête préparé. Cette requête me permet d'insérer dans users "dans la base de données"
    un pseudo, un password et un email. Les valeurs seront insérer en fonction de ce que écrira l'utilisateur dans les champs. D'ou VALUES (?, ?, ?) */

    public function addUser($pseudo, $password, $email) {
        $db = $this->dbConnect();
        $request = $db->prepare('INSERT INTO users (pseudo, password, email) VALUES (?, ?, ?)');
        $request->execute(array($pseudo, $password, $email));
    }

    /* Je crée ensuite une fonction qui me permettra de savoir si le nom d'utilisateur est déjà pris. Je passe donc en paramètre $pseudo 
    Je commence encore une fois par mettre en place la connexion a la base de données.
    Je crée ensuite une nouvelle requête préparé dans $request. Dans la requête SQL je dis que je selectionne tout dans user ou le pseudo est égale au pseudo rentré
    Ensuite j'execute la requête avec un tableau des pseudos 
    J'assigne le mot clé global a $checkedUserPseudo
    Je dis ensuite que $checkedUserPseudo est égale au nombre de ligne du tableau de ma requête
    Et enfin je retourne la valeur de checkedUserPseudo*/

    public function checkUserPseudo($pseudo) {
        $db = $this->dbConnect();
        $request = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
        $request->execute(array($pseudo));
        global $checkedUserPseudo;
        $checkedUserPseudo = $request->rowCount();
        return $checkedUserPseudo;
    }

    /* Je crée maintenant une fonction qui me permettra de savoir si l'email de l'utilisateur est déjà pris. Elle ressemble en tout point a la fonction
    CheckUserPseudo.
    Je comment encore une fois par mettre en place une connexion a la base de données.
    Je crée ensuite une requête préparé dans $request. Dans la requête SQL je dis que je selectionne tout dans user ou l'email est égale au mail rentré
    Ensuite j'execute la requête sous forme d'un tableau ou j'y insère les emails.
    J'assigne ensuite le mot clé flobal a $checkedUserEmail.
    Je dis ensuite que checkedUsserEmail est égale au nombre de ligne du tableau de ma requête
    Et pour terminer je retourne la valeur de checkedUserEmail */
    
    public function checkUserEmail($email) {
        $db = $this->dbConnect();
        $request = $db->prepare('SELECT * FROM users WHERE email = ?');
        $request->execute(array($email));
        global $checkedUserEmail;
        $checkedUserEmail = $request->rowCount();
        return $checkedUserEmail;
    }
    public function checkUserParams($pseudo) {
        $db = $this->dbConnect();
        $request = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
        $request->execute(array($pseudo));
        global $checkedUserParams;
        $checkedUserParams = $request->fetch();
        return $checkedUserParams;
    }
}