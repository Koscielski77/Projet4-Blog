<?php

namespace controllers;

/* J'utilise pour cette classe les modèles CommentManager / Message et PostManager */

use models\CommentManager;
use models\Message;
use models\PostManager;

/* Je crée une nouvelle classe AdminController qui va nous servir a faire tout ce qu'un administrateur est censé faire "Supprimer billet / Crée billet / ... "
*/

class AdminController {

    public function indexAction()
    {
        $newPostManager = new PostManager();
        $newCommentManager = new CommentManager();
        $posts = $newPostManager->getPosts();
        $comments = $newCommentManager->getReportedComments();
        require 'views/adminPanel.php';
    }

    public function postAction($title, $content)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (!empty($title) && !empty($content))
            {
                $newPostManager = new PostManager();
                $newPostManager->addPost($title, $content);
                $newMessage = new Message();
                $newMessage->setSuccess("<p>Merci, votre billet a bien été publié !</p>");
            }
            else
            {
                $newMessage = new Message();
                $newMessage->setError("<p>Tous les champs doivent être rempli !</p>");
            }
        }
        $newAdminController = new AdminController();
        $newAdminController->indexAction();
    }

    public function editPostAction($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $post = new PostManager();
            $post->updatePost($_GET['id'], htmlspecialchars($_POST['title']), htmlspecialchars($_POST['content']));
            $newMessage = new Message();
            $newMessage->setSuccess("<p>Merci, votre billet a bien été modifié !</p>");
        }
        $newPostManager = new PostManager();
        $post = $newPostManager->getPost($id);
        // Vue
        require 'views/editPost.php';
    }

    public function deletePostAction($id)
    {
        $newPostManager = new PostManager();
        $deletedPost = $newPostManager->deletePost($id);
        if ($deletedPost === false)
        {
            throw new Exception("Impossible de supprimer le billet !");
        }
        else
        {
            header('Location: ?controller=AdminController&action=indexAction');
        }
    }

    public function editCommentAction($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $comment = new CommentManager();
            $comment->updateComment($_GET['id'], htmlspecialchars($_POST['content']));
            $newMessage = new Message();
            $newMessage->setSuccess("<p>Merci, votre commentaire a bien été modifié !</p>");
        }
        $newCommentManager = new CommentManager();
        $comment = $newCommentManager->getComment($id);
        require 'views/editComment.php';
    }

    public function deleteCommentAction($id)
    {
        $newCommentManager = new CommentManager();
        $deletedComment = $newCommentManager->deleteComment($id);
        if ($deletedComment === false) {
            throw new \Exception("Impossible de supprimer le commentaire !");
        }
        else {
            header('Location: ?controller=AdminController&action=indexAction');
        }
    }
}
