<?php

namespace controllers;

use models\CommentManager;
use models\Message;

class CommentController {

    public function addCommentAction($post_id, $author, $content)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (!empty($author) && !empty($content))
            {
                $newCommentManager = new CommentManager();
                $newCommentManager->postComment($post_id, $author, $content);
                $newMessage = new Message();
                $newMessage->setSuccess("<p>Merci, votre commentaire a bien été publié !</p>");
                setcookie("author", $author, time() + 365*24*3600, null, null, false, true);
            }
            else
            {
                $newMessage = new Message();
                $newMessage->setError("<p>Tous les champs doivent être rempli !</p>");
            }
        }
        $newPostController = new PostController();
        $newPostController->showAction($post_id);
    }

    public function alertCommentAction($id, $post_id)
    {
        $newCommentManager = new CommentManager();
        $alertedComment = $newCommentManager->reportComment($id);
        if ($alertedComment === false) {
            throw new \Exception("Impossible de signaler le commentaire !");
        }
        else {
            header('Location: ?controller=PostController&action=showAction&id=' . $post_id);
        }
    }
}
