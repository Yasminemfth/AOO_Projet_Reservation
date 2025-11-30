<?php
require_once './app/utils/Render.php';
require_once './app/models/ReservationModel.php';

class ReservationController{

    use Render;

  public function findAll(): void
  {
    $reservationModel = new reservationModel();
    $reservations = $reservationModel->getAllReservations();
 
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
    $reservation = $reservationModel->getReservationsByUserId($id);
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

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { // si la methode n'est pas une methode POST
      $this->renderView('reservation/inserer', $data);
      return;
    }
    $userId = $_POST['userId'] ?? null;
    $activityId = $_POST['activityId'];

    if (empty($userId) || empty($activityId)) {// si c'est vide 
        $data['error'] = 'champ vides';
        $this->renderView('reservation/inserer', $data);
        return;
    }

    $reservation = $reservationModel->createReservation( $userId, $activityId);// utilisé la methode create du model

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
     $reservation = $reservationModel->cancelReservation( $userID, $activityId);// utilisé la methode create du model

      if ($reservation == false) {// si le résultat de la methode est false alors on envoie un message d'erreur
      $data['error'] = 'echec de la suppression';
      $this->renderView('reservation/inserer', $data);
      return;
    }

     $this->renderView('reservation/all', $data);
   }

 
  

}