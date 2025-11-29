<?php 


Class ReservationModel extends Bdd {

  public function __construct(){
    parent::__construct();
  }
 
  public function createReservation(int $userId, int $activityId) : bool
  {
        $now = new DateTime();
        $query = "INSERT INTO `reservations`(`userId`, `activityId`,`RservationDate`) VALUES ($userId,$activityId,$now)";
        $reservations = $this->co->prepare($query);
        $reservations->execute();
        return True;  
  }
   public function getReservationsByUserId(int $userId) : array
   {
      $reservations = $this->co->prepare("SELECT * FROM `reservations` WHERE reservations['userId'] == '$userId'");
      $reservations->execute();
      return $reservations; 
   }
 
   public function cancelReservation(int $reservationId) : bool
   {
      $now = new DateTime();
      $query = "DELETE FROM `reservations` WHERE reservations['reservationId'] == '$reservationId' ";
      $reservations = $this->co->prepare($query);
      $reservations->execute();
      return True;  
   }
 
  }
