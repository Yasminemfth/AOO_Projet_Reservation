<?php
if (isset($_SESSION['id'])) {
  
  echo '<h1>Reservation  de  '.$_SESSION['firstname'].$_SESSION['name'].' : </h1>';
  $error = "cette information n'existe pas dans la base de donnée ";
  echo '<br><hr><br>';
  echo '<h2> Information utilisateur :</h2><br>';  
  echo '<p> Id :'.$_SESSION['id'] .'</p>';
  echo '<p> name :'.$_SESSION['name'].'</p>';
  echo '<p> firstname :'.$_SESSION['firstname'].'</p>';
  echo '<p>  email :'.$_SESSION['email'].'</p>';

  echo '<br><hr><br>';
  echo '<h2> Information Reservation :</h2><br>';  
  echo '<p> User Id :'.$_SESSION['userId'].'</p>';
  echo '<p> Activité :'.$_SESSION['activityId'] .'</p>';
  echo '<p> Date de Réservation : ' .$_SESSION['ReservationDate']. '</p>';
}
  else {
   header('Location: /user/login');
}
  

