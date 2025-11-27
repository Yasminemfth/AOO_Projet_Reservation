<?php 
echo "utilisateurs : <br>";
foreach ($users as $user) {
  echo '<h3>'. $user['name'] . $user['firstname'] .'</h3>';
  echo '<p>' . $user['email'] . '</p>';
}