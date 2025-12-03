<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/CSS/destyle.css">
    <link rel="stylesheet" href="/CSS/variables.css">
    <link rel="stylesheet" href="/CSS/header.css">

    <title><?= $title ?? 'Mon titre par défaut' ?></title>
</head>
<body>
    <header>
        <h1>Reservation Project</h1>
        <nav>
        <!-- Lien vers les pages utilisateurs-->
          <a href="/user/findAll">Liste des utilisateurs</a>
          <a href="/user/signUp">Inscription</a>
          <a href="/user/logIn">Connexion</a>
          <a href="/user/logOut">Deconnexion</a>

        <!-- Lien vers les pages activités -->
            <a href="/activite/findAll">Liste desActivités</a>

        <!-- Lien vers les pages de reservation -->
            <a href="/reservation/findOneById/<?= htmlspecialchars($_SESSION['id']??1) ?>">Liste des Reservations</a>
            <a href="/reservation/AjouterReservation">Reserver</a>

            <!-- Si admin : lien pour ajouter une activité -->
            <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="/activite/create">Ajouter une activité</a>
            <?php endif; ?>
        </nav>
        <?php 
        if(isset($_SESSION['name']) && !empty($_SESSION['name'])) {
            echo $_SESSION['id'];
            echo $_SESSION['name'];
            echo $_SESSION['firstname'];
            echo $_SESSION['email'];
        }
        ?>
    </header>
    
    <main>
        <?= $content ?? '<p>Aucun contenu à afficher</p>' ?>
    </main>
    
    <footer>
        <p>Tous droits réservés</p>
    </footer>
</body>
</html>