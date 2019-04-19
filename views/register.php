<?php
$title = 'Inscription';
?>

<!-- On utilise ob_start() qui au lancement de la page démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon. -->

<?php ob_start(); ?>

<h1>Inscription</h1>

<!-- Si la variable $message est set, on renvoi un message suivant ce que l'utilisateur nous renvoi -->

<?php
    if (isset($message)) {
        echo "<p>" . $message . "</p>";
    }
?>

<form action="" method="POST">

    <div class="form-group">
        <label for="">Pseudo :</label>
        <input type="text" name="pseudo" class="form-control" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>">
    </div>

    <div class="form-group">
        <label for="">Mot de passe :</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Confirmez le mot de passe :</label>
        <input type="password" name="password_confirm" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Email :</label>
        <input type="text" name="email" class="form-control" value="<?php if(isset($email)) { echo $email; } ?>">
    </div>

    <button type="submit" class="btn btn-primary">M'inscrire</button>

</form>

<!-- On execute ob_get_clean qui lit le contenu courant du tampon de sortie puis l'efface -->

<?php $content = ob_get_clean(); ?>

<!-- On ajoute la vue de la template -->

<?php require('views/template.php'); ?>