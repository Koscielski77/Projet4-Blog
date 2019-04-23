<?php

namespace controllers;

use models\PostManager;
use models\CommentManager;

/* Je crée une nouvelle class PostController qui va me servir pour l'affichage des billets
Je crée une fonction public indexAction, qui vas me servir a afficher la liste des posts a l'accueil
Je crée une nouvelle instance de PostManager que je stock dans $newPostManager
Je dis que la variable post est égale a $newPostManager dans laquel j'execute getPreviousPosts
Je renvoi enfin la liste des posts */

class PostController {

    public function indexAction()
    {
        $newPostManager = new PostManager();
        $posts = $newPostManager->getPreviousPosts();
        require 'views/listPosts.php';
    }

    /* Je crée une nouvelle fonction public qui va me servir a afficher le dernier post
    Je crée une nouvelle instance de PostManager() que je met dans la variable $newPostManager
    Je dis que la variable $lastPost est égale a $newPostManager dans laquel j'execute la fonction getLastPost qui va me premettre 
    de récupérer le dernier post.
    Enfin je renvoi la page lastPost.php */
    
    public function showLastPostAction()
    {
        $newPostManager = new PostManager();
        $lastPost = $newPostManager->getLastPost();
        require 'views/lastPost.php';
    }

    /* Je crée une nouvelle fonction qui va me permettre d'afficher le contenue du billet, je passe en paramètre l'id de l'article
    Je crée une nouvelle instance de PostManager() que je met dans la variable $newPostManager
    Je crée également une nouvelle instance de CommentManager() que je met dans la variable $newCommentManager(); 
    Je récupère les posts ainsi que les commentaires
    Si l'id du post est égal a null on renvoi sur la page d'erreur, sinon on affiche le post */
    
    public function showAction($id)
    {
        $newPostManager = new PostManager();
        $newCommentManager = new CommentManager();
        $post = $newPostManager->getPost($id);
        $comments = $newCommentManager->getComments($id);
        if ($post->getId() == null)
        {
            require 'views/error.php';
        }
        else
        {
            require 'views/postView.php';
        }
    }
}
