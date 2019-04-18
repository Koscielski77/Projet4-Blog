<?php
namespace model;
class User {

    /* Je commence par crée 4 attribut ($id, $pseudo, $passowrd et $email) qui me serviront pour l'utilisateur
    Je les mets en privée pour pas que ces attributs soient accessible hors de ma class */

    private $id;
    private $pseudo;
    private $password;
    private $email;

    /* Je crée une fonction contrutcteur dans laquel je passe en paramètre mes attributs que j'ai défini plus haut
    J'indique que id = $id, pseudo = $pseudo, password = $password et email = $email. J'utilise le mot clé this pour faire 
    référence a la class courante qui est donc User */

    public function __contruct ($id, $pseudo, $password, $email) {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->email = $email;
    }

    /* Je commence a crée mes getters qui vont me permettre de récupérer et d'accéder aux attributs */

    public function getId() {
        return $this->id;
    }
    public function getPseudo() {
        return $this->pseudo;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getEmail() {
        return $this->email;
    }

    /* Je crée des setters qui vont me permettre de modifier des attributs */

    public function setId($id) {
        $this->id = $id;
    }
    public function setPseudo($pseudo) {
        $this->id = $pseudo;
    }
    public function setPassword($password) {
        $this->id = $password;
    }
    public function setEmail($email) {
        $this->id = $email;
    }
}