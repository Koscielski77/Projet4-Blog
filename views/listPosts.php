<?php
    $title = 'Mon blog';
?>

<?php ob_start(); ?>

<h1>Liste des billets</h1>

<?php
    if (isset($_SESSION) && !empty($_SESSION))
    {
        echo "<p>Vous êtes connecté ! Bonjour " . $_SESSION['pseudo'] . " !</p>";
    }
    else {
        echo "Bonjour visiteur !";
    }
?>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>