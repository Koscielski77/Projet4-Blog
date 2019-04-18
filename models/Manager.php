<?php
namespace models;

/* Je crée une nouvelle class Manager qui va me permettre de crée ma connexion a la base de données */

class Manager {

    /* Je commence par crée une fonction protected qui ne pourra être appelé que dans la classe et le classes qui en héritent 
    Je fais ensuite une requête de connexion a la base de données que j'assigne a $db */

    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
        return $db;
    }
}