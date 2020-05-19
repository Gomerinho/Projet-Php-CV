<?php
//Permet de savoir si une sessions est déjà initier
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Si il y a une session qui existe déjà et qui correspond à notre utilisateur on le renvoie directement sur la page administrateur
if (isset($_SESSION['auth'])) {
    header('Location: admin.php');
    exit();
}

//On vérifie que le formulaire a été rempli correctement
if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
    require_once 'inc/db.php';
    $req = $pdo->query('SELECT * FROM user');
    $user = $req->fetch(PDO::FETCH_OBJ);
    if ($_POST['password'] == $user->password) { //On vérifie le mot de passe, si il correspond à celui dans la BDD, pour l'instant aucune Sécurité (il faudrait un hash et un password_verify())
        session_start(); //on initie la nouvelle sessions
        $_SESSION['auth'] = $user; //la super globale SESSION contient toutes les infos de notres utilisateur
        $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté'; //Permet de créer un "flash" message pour avertir l'utilisateur d'érreur ou de succès
        header('Location: admin.php'); //redirection vers la page admin
        exit();
    } else {
        $errors['username'] = 'Identifiant ou mot de passe incorrecte'; //création d'une érreur qui pourra être affiché
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mon CV</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="css/admin.css" rel="stylesheet">

</head>

<div class="container">
    <?php if (isset($_SESSION['flash'])) : ?>
        <!-- Affichage d'un message(positif ou négatif)-->
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div class="alert alert-<?= $type ?> " style="margin-top: 10%;width : 50%;">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif ?>
    <?php if (!empty($errors)) : ?>
        <!-- Affichage des erreurs -->
        <div class="alert alert-danger" role="alert">
            Vous n'avez pas remplis le formulaire correctement
            <ul class="list-group list-group-flush">
                <?php foreach ($errors as $error) : ?>
                    <li class="list-group-item"><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="Pseudo">Pseudo</label>
            <input type="text" class="form-control" id="Pseudo" placeholder="Entrez votre pseudo" name="username">
        </div>
        <div class="form-group">
            <label for="Password">Mot de passe</label>
            <input type="password" class="form-control" id="Password" placeholder="Mot de passe" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Connexion</button>
    </form>
</div>