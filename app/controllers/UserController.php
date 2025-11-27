<?php

require_once './app/utils/Render.php';

class UserController{

    use Render;

  public function findAll(): void
  {
    $userModel = new UserModel();
    $users = $userModel->findAll();
 
    // Prépatation du tableau à envoyer au layout
    $data = [
      'title' => 'Liste des utilisateurs',
      'users' => $users
    ];
 
    // Rendu avec layout
    $this->renderView('user/all', $data);
  }
 
  public function findOneById(int $id): void
  {
    $userModel = new UserModel();
    $user = $userModel->findOneById($id);
    $data = [
      'title' => 'Un utilisateur',
      'user' => $user
    ];
 
    // Rendu avec layout
    $this->renderView('user/one', $data);
  }

    public function logIn(): void
  {
    $userModel = new UserModel();
    $data = [
      'title' => 'Log In',
    ];

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      $this->renderView('user/logIn', $data);
      return;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $this->renderView('user/logIn', $data);
        return;
    }

    $userModel->logIn( $email, $password);
    return;
  }

    public function signUp(): void
  {
    $userModel = new UserModel();
    $data = [
      'title' => 'Sign Up',
      'error' => ''
    ];

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      $this->renderView('user/signUp', $data);
      return;
    }

    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($name) || empty($firstname) || empty($email) || empty($password)) {
      $data['error'] = 'champ vide';
        $this->renderView('user/signUp', $data);
        return;
    }

    $passwordhash = password_hash($password, PASSWORD_DEFAULT);

    $userModel->signUp($name, $firstname, $email, $passwordhash);
    header('Location: user/login');
    return;
  }
}