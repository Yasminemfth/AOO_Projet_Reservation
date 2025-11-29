<?php
echo "<h2>Activités :</h2><br>";

foreach ($activites as $activite) {
    echo '<h3>ID : ' . $activite['id'] . '</h3>';
}

// Bouton visible seulement pour les admins
if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    echo '<a href="ajouter-activite.php" class="btn btn-primary">Ajouter une activité</a>';
}
?>
