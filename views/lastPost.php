<?php $title = 'Dernier chapitre'; ?>

<!-- On utilise ob_start() qui au lancement de la page démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon. -->

<?php ob_start(); ?>

<!-- Je crée une div avec la class LastPost, c'est dans cette div que je placerais le titre
Je recupère le titre grâce a $lastPost dans laquel je passe en paramètre title "donc le titre du dernier article" -->

<div class="LastPost">
    <h4><?php echo $lastPost['title'] ?></h4>
</div>

<!-- J'ajoute un trait que j'ai fais grâce a une simple border pour apporter plus d'esthétisme -->

<div class="trait"></div>

<!-- Je m'occupe maintenant de retranscrire les données du dernier article -->

<p>Publié le : <?php echo $lastPost['added_datetime_fr'] ?><br>
<?php echo $lastPost['author'] ?></p>
<p><?php echo html_entity_decode($lastPost['content']) ?> </p>
<a href="?controller=PostController&action=showAction&id=<?= $lastPost['id'] ?>" title="Lire les commentaires">Lire les commentaires</a>
<hr>

<!-- On execute ob_get_clean qui lit le contenu courant du tampon de sortie puis l'efface -->

<?php $content = ob_get_clean(); ?>

<!-- On ajoute également la template -->

<?php require('views/template.php'); ?>