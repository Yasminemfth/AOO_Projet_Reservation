<?php 
echo "Reservation : <br>";
foreach ($reservations as $reservation) {
  echo '<h3> User :'. $reservation['userId'].'</h3>';
  echo '<h3> Activité :'. $reservation['activityId'] .'</h3>';
  echo '<p> Date de Réservation : ' . $reservation['ReservationDate'] . '</p>';
}