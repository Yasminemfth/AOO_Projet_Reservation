<?php
require_once './app/utils/Render.php';

class ReservationController{

    use Render;

  public function findAll(): void
  {
    $reservationModel = new UserModel();
    $reservations = $reservationModel->findAll();
 
    // Prépatation du tableau à envoyer au layout
    $data = [
      'title' => 'Liste des reservations',
      'reservations' => $reservations
    ];
 
    // Rendu avec layout
    $this->renderView('reservation/all', $data);
  }
 
  public function findOneById(int $id): void
  {
    $reservationModel = new ReservationModel();
    $reservation = $reservationModel->findOneById($id);
    $data = [
      'title' => 'Une réservation',
      'reservation' => $reservation
    ];
 
    // Rendu avec layout
    $this->renderView('reservation/one', $data);
  }

    public function AjouterReservation(): void
  {
    $reservationModel = new ReservationModel();//création du model
    $data = [
      'title' => 'ajouter une réservation',
    ];

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { // si la methode est bien une methode POST
      $this->renderView('reservation/all', $data);
      return;
    }

    $userId = $_POST['userId'];// on récupère le requète du formulaire
    $activityId = $_POST['activityId'];

    if (empty($userId) || empty($activityId)) {// si c'est vide 
        $data['error'] = 'champ vides';
        $this->renderView('reservation/inserer', $data);
        return;
    }

    $reservation = $reservationModel->createReservation( $userID, $activityId);// utilisé la methode create du model

    if ($reservation == false) {// si le résultat de la methode est false alors on envoie un message d'erreur
      $data['error'] = 'userId or activityId incorrect';
      $this->renderView('reservation/inserer', $data);
      return;
    }

    $_SESSION['reservationId'] = $reservation['reservationId'];
    $_SESSION['userId'] = $reservation['userId'];
    $_SESSION['activityId'] = $reservation['activityId'];
    $_SESSION['ReservationDate'] = $reservation['ReservationDate'];
   

    header('Location: findAll');
    return;
  }

   public function enleverReservation(): void
   {
      $reservationModel = new ReservationModel();
      $data = [
      'title' => 'enlever une réservation',
    ];
     $reservation = $reservationModel->createReservation( $userID, $activityId);// utilisé la methode create du model

      if ($reservation == false) {// si le résultat de la methode est false alors on envoie un message d'erreur
      $data['error'] = 'echec de la suppression';
      $this->renderView('reservation/inserer', $data);
      return;
    }

     $this->renderView('reservation/all', $data);
   }

 
  

}