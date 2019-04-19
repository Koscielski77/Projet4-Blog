<?php
    /* On démarre la session.
    On met la session dans un tableau
    Puis on la détruit
    Et on renvoi vers l'index */
    
    session_start();
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");

?>