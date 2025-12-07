<?php

//trait authentification qui vérifie que le user est co et ou admin
trait Auth {

    // vérifie que l'utilisateur est connecté
    public function requireAuth()
    {
        if (empty($_SESSION['id'])) {
            header("Location: /user/logIn");
            exit();
        }
    }

    // vérifie que l'utilisateur est admin
    public function requireAdmin()
    {
        if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            die("Accès interdit ");
        }
    }
}
