<?php

namespace models;

class CommentManager extends Manager {

    public function getComments($post_id)
    {
        $newManager = new Manager();
        $db = $newManager->dbConnect();
        $request = $db->prepare('SELECT id, post_id, author, content, alert, DATE_FORMAT(added_datetime, \'%d/%m/%Y à %Hh%i\') AS added_datetime_fr, updated_datetime FROM comments WHERE post_id = ?');
        $request->execute(array($post_id));
        $result = $request->fetchAll();
        $comments = [];
        foreach ($result as $comment) {
            $newComment = new Comment($comment['id'], $comment['post_id'], $comment['author'], $comment['content'], $comment['alert'], $comment['added_datetime_fr'], $comment['updated_datetime']);
            $comments[] = $newComment;
        }
        return $comments;
    }

    public function postComment($post_id, $author, $content)
    {
        $newManager = new Manager();
        $db = $newManager->dbConnect();
        $comments = $db->prepare('INSERT INTO comments (post_id, author, content, alert, added_datetime) VALUES (?, ?, ?, 0, NOW())');
        $affectedLines = $comments->execute(array($post_id, $author, $content));
        return $affectedLines;
    }

    public function reportComment($id)
    {
        $newManager = new Manager();
        $db = $newManager->dbConnect();
        $request = $db->prepare('UPDATE comments SET alert = alert + 1 WHERE id = ?');
        $alertedComment = $request->execute(array($id));
        return $alertedComment;
    }

    public function getReportedComments()
    {
        $newManager = new Manager();
        $db = $newManager->dbConnect();
        $request = $db->query('SELECT id, post_id, author, content, alert, DATE_FORMAT(added_datetime, \'le %d/%m/%Y à %Hh%i\') AS added_datetime_fr, DATE_FORMAT(updated_datetime, \'le %d/%m/%Y à %Hh%i\') AS updated_datetime_fr FROM comments WHERE alert != 0 ORDER BY alert DESC LIMIT 10');
        $request->execute(array());
        $result = $request->fetchAll();
        $comments = [];
        foreach ($result as $comment) {
            $newComment = new Comment($comment['id'], $comment['post_id'], $comment['author'], $comment['content'], $comment['alert'], $comment['added_datetime_fr'], $comment['updated_datetime_fr']);
            $comments[] = $newComment;
        }
        return $comments;
    }

    public function getComment($id)
    {
        $newManager = new Manager();
        $db = $newManager->dbConnect();
        $request = $db->prepare('SELECT id, post_id, author, content, alert, added_datetime, updated_datetime FROM comments WHERE id = ?');
        $request->execute(array($id));
        $comment = $request->fetch();
        return new Comment($comment['id'], $comment['post_id'], $comment['author'], $comment['content'], $comment['alert'], $comment['added_datetime'], $comment['updated_datetime']);
    }

    public function updateComment($id, $content)
    {
        $newManager = new Manager();
        $db = $newManager->dbConnect();
        $request = $db->prepare('UPDATE comments SET content = ?, updated_datetime = NOW() WHERE id = ?');
        $comment = $request->execute(array($content, $id));
        return $comment;
    }

    public function deleteComment($id)
    {
        $newManager = new Manager();
        $db = $newManager->dbConnect();
        $request = $db->prepare('DELETE FROM comments WHERE id = ?');
        $deletedComment = $request->execute(array($id));
        return $deletedComment;
    }
}
