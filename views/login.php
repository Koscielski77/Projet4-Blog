<?php $title = 'Connexion'; ?>

<!-- On utilise ob_start() qui au lancement de la page démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon. -->

<?php ob_start(); ?>

<!-- Titre de connexion classique -->

<h1>Connexion</h1>

<!-- Si la variable message est "set". On affiche un message suivant les informations qu'a rentré l'utilisateur -->

<?php
if (isset($message)) {
    echo "<p>" . $message . "</p>";
}
?>

<form action="" method="POST">

    <div class="form-group">
        <label for="">Pseudo</label>
        <input type="text" name="pseudo" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Mot de passe</label>
        <input type="password" name="password" class="form-control">
    </div>

    <button class="btn btn-primary">Me connecter</button>

</form>

<!-- On execute ob_get_clean qui lit le contenu courant du tampon de sortie puis l'efface -->

<?php $content = ob_get_clean(); ?>

<!-- On ajoute la vue de la template -->

<?php require('views/template.php'); ?>