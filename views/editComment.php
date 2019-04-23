<?php $title = 'Modifier un commentaire'; ?>

<?php ob_start(); ?>

<h3>Modifier un commentaire :</h3>

<form action="?controller=AdminController&action=editCommentAction&id=<?php echo $comment->getId() ?>" method="post">
    <label for="author" value="<?php echo $comment->getAuthor() ?>">Auteur :</label></br>
    <input type="text" id="author" name="author" class="form-control" value="<?php echo $comment->getAuthor() ?>" disabled="disabled"></br>
    <label for="content">Contenu :</label></br>
    <textarea name="content" id="content" cols="30" rows="10" class="mceEditor"><?php echo $comment->getContent() ?></textarea></br>
    <button class="btn btn-primary">Modifier</button>
</form>
<hr>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>
