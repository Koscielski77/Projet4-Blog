<?php $title = 'Administration'; ?>
 
<!-- On utilise ob_start() qui au lancement de la page démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon. --> 

<?php ob_start(); ?>

<div class="title">
    <h1>Administration</h1>
</div>
<hr>
<br/>

<h4>Publier un article</h4>
<br />
<br />

<!-- On initialise la méthode utilisé pour la création de notre article -->
<!-- On y ajoute ensuite ce qu'il y a de basique, c'est a dire un label, un input text pour le titre, au autre label et enfin un textarea ou notre
éditeur de texte sera inclus -->

<form action="?controller=AdminController&action=postAction" method="post">
    <label for="title">Titre :</label></br>
    <input type="text" id="title" name="title" class="form-control"/></br>
    <label for="content">Contenu :</label></br>
    <textarea id="content" name="content" cols="30" rows="5" class="mceEditor"></textarea></br>
    <button class="btn btn-primary">Publier</button>
</form>
<hr>
<br />

<!-- On ajoute la liste des postes en ligne -->

<?php
    include 'inc/_onlinePosts.php';
?>
<br />

<!-- On ajoute la liste des commentaires reportés -->
<?php
    include 'inc/_reportedComments.php';
?>
<hr>

<!-- On execute ob_get_clean qui lit le contenu courant du tampon de sortie puis l'efface -->

<?php $content = ob_get_clean(); ?>

<!-- Enfin on ajoute la template -->

<?php require('views/template.php'); ?>
