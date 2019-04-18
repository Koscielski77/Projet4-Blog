<!-- On crée une page d'erreur qui servira de page "erreur 404" -->

<?php $title = 'Erreur'; ?>

<!-- On utilise ob_start() qui au lancement de la page démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon. -->

<?php ob_start(); ?>

<!-- On dit a l'utilisateur que cette page n'existe pas et on lui propose de revenir l'accueil du site "l'index" -->

<h1>Cette page n'existe pas !</h1>
<br />
<h4><a href="index.php" title="Accueil">Revenir à l'accueil du site</a></h4>


<!-- On execute ob_get_clean qui lit le contenu courant du tampon de sortie puis l'efface -->

<?php $content = ob_get_clean(); ?>

<!-- On ajoute une vue de la template -->

<?php require('views/template.php'); ?>