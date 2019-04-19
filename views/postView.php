<?php $title = $post->getTitle() ?>

<!-- Si la variable message est "set". On affiche un message suivant les informations qu'a rentré l'utilisateur -->

<?php ob_start(); ?>

<p><a href="?controller=PostController&action=indexAction">Retour à la liste des billets</a></p>

<!-- On recupère le titre, la date, l'auteur, et le contenue du message -->

<div class="LastPost">
    <h4><?php echo html_entity_decode($post->getTitle()) ?></h4>
</div>
<div class="trait"></div>
    <p>Publié le : <?php echo $post->getAddedDatetime() ?><br>
    <?php echo html_entity_decode($post->getAuthor()) ?></p>
    <p><?php echo html_entity_decode($post->getContent()) ?></p>
<hr>


<!-- Secton commantaire -->

<h4>Commentaires :</h4><br />
<?php
foreach ($comments as $comment) {
    echo "<br />";
    echo "<p>De : " . html_entity_decode($comment->getAuthor()) . ", ajouté le : " . $comment->getAddedDatetime() . "</br>";
    echo html_entity_decode($comment->getContent()) . "<br />";
    echo '<a href="?controller=PostController&action=alertCommentAction&id=' . $comment->getId() . '&post_id=' . $comment->getPostId() . '" onclick="return(confirm(\'ATTENTION ! Voulez-vous vraiment signaler ce commentaire ?\'))">Signaler</a>';
    echo "<br />";
}
?>
<hr>

<!-- Section ajout de commentaire -->

<h4>Ajouter un commentaire : </h4><br />
<form action="?controller=PostController&action=addCommentAction&id=<?php echo $_GET['id'] ?>" method="post">
    <label for="author">Auteur : </label></br>
    <input type="text" id="author" name="author" class="form-control" value="<?php if(isset($_COOKIE['author'])) { echo $_COOKIE['author']; } ?>"/></br>
    <label for="content">Contenu : </label></br>
    <textarea id="content" name="content" class="form-control" value=""></textarea></br>
    <button class="btn btn-primary">Publier</button>
</form>
<br/>
<hr>

<!-- On execute ob_get_clean qui lit le contenu courant du tampon de sortie puis l'efface -->

<?php $content = ob_get_clean(); ?>

<!-- On ajoute la vue de la template -->

<?php require('views/template.php'); ?>