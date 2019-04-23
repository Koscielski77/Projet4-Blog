<?php

namespace controllers;

session_start();

require 'vendor/autoload.php';

if (isset($_GET['controller'])) {
    if (isset($_GET['action'])) {
        if ($_GET['controller'] == 'UserController') {
            if ($_GET['action'] == 'registerAction') {
                $pseudo = isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : NULL;
                $password_hash = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : NULL;
                $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : NULL;
                $newUserController = new UserController();
                $newUserController->register($pseudo, $password_hash, $email);
            }
            elseif ($_GET['action'] == 'loginAction') {
                $pseudo = isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : NULL;
                $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : NULL;
                $newUserController = new UserController();
                $newUserController->login($pseudo, $password);
            }
            elseif ($_GET['action'] == 'logoutAction') {
                require 'views/logout.php';
            }
            else {
                require 'views/error.php';
            }
        }
        elseif ($_GET['controller'] == 'PostController') {
            if ($_GET['action'] == 'indexAction') {
                $newPostController = new PostController();
                $newPostController->indexAction();
            }
            elseif ($_GET['action'] == 'showAction') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $newPostController = new PostController();
                    $newPostController->showAction($_GET['id']);
                } else {
                    require 'views/error.php';
                }
            }
            elseif ($_GET['action'] == 'addCommentAction') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $author = isset($_POST['author']) ? htmlspecialchars($_POST['author']) : NULL;
                    $content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : NULL;
                    $newCommentController = new CommentController();
                    $newCommentController->addCommentAction($_GET['id'], $author, $content);
                } else {
                    require 'views/error.php';
                }
            }
            elseif ($_GET['action'] == 'alertCommentAction') {
                if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['post_id']) && $_GET['post_id'] > 0) {
                    $newCommentController = new CommentController();
                    $newCommentController->alertCommentAction($_GET['id'], $_GET['post_id']);
                }
            }
            elseif ($_GET['action'] == 'about') {
                require 'views/about.php';
            }
            else {
                require 'views/error.php';
            }
        }
        elseif (isset($_SESSION) && !empty($_SESSION)) {
            if ($_GET['controller'] == 'AdminController') {
                if ($_GET['action'] == 'indexAction') {
                    $newAdminController = new AdminController();
                    $newAdminController->indexAction();
                }
                elseif ($_GET['action'] == 'postAction') {
                    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : NULL;
                    $content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : NULL;
                    $newAdminController = new AdminController();
                    $newAdminController->postAction($title, $content);
                }
                elseif ($_GET['action'] == 'editPostAction') {
                    $newAdminController = new AdminController();
                    $newAdminController->editPostAction($_GET['id']);
                }
                elseif ($_GET['action'] == 'deletePostAction') {
                    $newAdminController = new AdminController();
                    $newAdminController->deletePostAction($_GET['id']);
                }
                elseif ($_GET['action'] == 'editCommentAction') {
                    $newAdminController = new AdminController();
                    $newAdminController->editCommentAction($_GET['id']);
                }
                elseif ($_GET['action'] == 'deleteCommentAction') {
                    $newAdminController = new AdminController();
                    $newAdminController->deleteCommentAction($_GET['id']);
                }
                else {
                    require 'views/error.php';
                }
            }
        }
        else {
            require 'views/error.php';
        }
    }
    else {
        require 'views/error.php';
    }
}
else {
    $newPostController = new PostController();
    $newPostController->showLastPostAction();
}
