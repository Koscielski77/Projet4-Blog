<?php $title = 'Liste des chapitres'; ?>

<!-- On utilise ob_start() qui au lancement de la page démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon. -->

<?php ob_start(); ?>


<?php
while ($post = $posts->fetch())
{ ?>

        <!-- On crée une div ou seront inséré les différents articles 
        On recupère le titre grâce a $post['title'], on utilise html_entity_decode qui convertit les entités HTML à leurs caractères correspondant
        On ajoute ensuite un trait qui rend la page plus esthétique 
        On ajoute ensuite la date de publication de l'article 
        On limite le nombre de caractères du contenu affichés à l'accueil 
        Et enfin, on ajoute un bouton qui redirige vers le billet en question -->

        <div class="LastPost"><h4><?= (html_entity_decode($post['title'])) ?></h4></div>
        <div class="trait"></div>
        <p>Publié le <?= $post['added_datetime_fr'] ?></p>
        <p><?= substr (nl2br(html_entity_decode($post ['content'])), 0, 350) . '...' ?>
        <a href="?controller=PostController&action=showAction&id=<?= $post['id'] ?>" title="Lire le billet" >Lire la suite</a></p>
        <br />
    <?php
}
$posts->closeCursor();
?>

<!-- On execute ob_get_clean qui lit le contenu courant du tampon de sortie puis l'efface -->

<?php $content = ob_get_clean(); ?>

<!-- On ajoute la vue de la template -->

<?php require('views/template.php'); ?>