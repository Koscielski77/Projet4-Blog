<!-- Titre de la page -->
<?php $title = 'Modifier un billet'; ?>

<!-- On utilise ob_start() qui au lancement de la page démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon. -->

<?php ob_start(); ?>

<h3>Modifier un billet :</h3>

<form action="?controller=AdminController&action=editPostAction&id=<?php echo $post->getId() ?>" method="post">
    <label for="title">Titre :</label></br>
    <input type="text" id="title" name="title" class="form-control" value="<?php echo $post->getTitle() ?>"></br>
    <label for="content">Contenu :</label></br>
    <textarea name="content" id="content" cols="30" rows="10" class="mceEditor"><?php echo $post->getContent() ?></textarea></br>
    <button class="btn btn-primary">Modifier</button>
</form>
<hr>

<!-- On execute ob_get_clean qui lit le contenu courant du tampon de sortie puis l'efface -->

<?php $content = ob_get_clean(); ?>

<!-- Requiert le fichier template.php -->
<?php require('views/template.php'); ?>