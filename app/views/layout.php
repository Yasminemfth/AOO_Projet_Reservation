<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../../CSS/variable.css">
    <!-- <link rel="stylesheet" href="/assets/style.css"> -->

    <title><?= $title ?? 'Mon titre par défaut' ?></title>
</head>
<body>
    <header>
        <h1>Reservation Project</h1>
        <nav>
          <a href="/user/findAll">Liste des utilisateurs</a>
          <a href="/user/signUp">Inscription</a>
          <a href="/user/logIn">Connexion</a>
        </nav>
    </header>
    
    <main>
        <?= $content ?? '<p>Aucun contenu à afficher</p>' ?>
    </main>
    
    <footer>
        <p>Tous droits réservés</p>
    </footer>
</body>
</html>