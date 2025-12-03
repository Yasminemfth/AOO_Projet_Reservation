<?php 


Class ReservationModel extends Bdd {

  public function __construct(){
    parent::__construct();
  }
 
  public function createReservation(int $userId, int $activityId) : bool
  {
        $now = new DateTime();
        $now = $now->format('Y-m-d H:i:s');
        $reservations = $this->co->prepare("INSERT INTO reservations (userId, activityId, ReservationDate) VALUES (:userId, :activityId, :ReservationDate)");
        $reservations->execute([
      ':userId' => $userId,
      ':activityId' => $activityId,
      ':ReservationDate' => $now
    ]);
        return True;  
  }
  public function getReservationsByUserId(int $userId) : array
{
    $sql = "SELECT * FROM `reservations` WHERE `userId` = $userId";
    $stmt = $this->co->prepare($sql);
    $stmt->execute();

    $reservations = $stmt->fetchAll(\PDO::FETCH_ASSOC); 
    
    return $reservations;
}

     public function getAllReservations() : array
   {
      $stmt = $this->co->prepare("SELECT * FROM `reservations`");
      $stmt->execute();
      $reservations = $stmt->fetchAll(); 
      return $reservations;
   }
 
   public function cancelReservation(int $reservationId) : bool
   {
      $query = "DELETE FROM `reservations` WHERE reservations['reservationId'] == '$reservationId' ";
      $reservations = $this->co->prepare($query);
      $reservations->execute();
      return True;  
   }
 
  }
