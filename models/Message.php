<?php

namespace models;

/* On crée une nouvelle class Message. Cette classe nous servira a retourner des messages a l'utilisateur.
Plus particulièrement pour l'enregistrement ou la connexion de l'utilisateur */

class Message {

    public function __contruct()
    {

    }

    public function setError($message)
    {
        global $alert;
        $alert = [
            'alertMessage' => $message
        ];
    }

    public function setSuccess($message)
    {
        global $success;
        $success = [
            'successMessage' => $message
        ];
    }
}