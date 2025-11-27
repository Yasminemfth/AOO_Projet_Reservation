<?php 

class UserModel extends Bdd{
 
  public function __construct(){
    parent::__construct();
  }
 
  public function findAll(): array
  {
    $users = $this->co->prepare('SELECT * FROM users');
    $users->execute();
 
    return $users->fetchAll();
  }
 
  public function findOneById(int $id): User | false
  {
    $users = $this->co->prepare('SELECT * FROM Users WHERE id = :id LIMIT 1');
    $users->setFetchMode(PDO::FETCH_CLASS, 'User');
    $users->execute([
      ':id' => $id
    ]);
 
    return $users->fetch();
  }

    public function signUp($name, $firstname, $email, $passwordhash) : bool
  {
    $userSignUp = $this->co->prepare('INSERT INTO Users (name, firstname, email, password, role) 
                                      VALUES (:name, :firstname, :email, :password, :role)');
    $userSignUp->execute([
      ':name' => $name,
      ':firstname' => $firstname,
      ':email' => $email,
      ':password' => $passwordhash,
      ':role' => 'User'
    ]);
 
    return True;
  }

    public function logIn(string $email, $password): array | false
  {
    $request = $this->co->prepare('SELECT * FROM Users WHERE email = :email LIMIT 1');
    $request->execute([
      ':email' => $email
    ]);
    $user = $request->fetch();

    if(!$user) {
      return false;
    }

    if (password_verify($password, $user['password'])) {
      return $user;
    } else {
      return false;
    }
  }
}