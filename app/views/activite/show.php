<?php
echo "<h2>Activités :</h2><br>";

foreach ($activites as $activite) {
    echo '<p>Description : ' . $activite['description'] . '</p>';
    
}
