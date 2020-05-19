<?php

require_once 'inc/db.php';

if (isset($_POST['ajouter_certif'])) { //verification de quelle bouton à était utilsé
    $req = $pdo->prepare("INSERT INTO certification SET nom = ?");
    $req->execute([$_POST['nom']]);
    header('Location: index.php');
    exit();
} elseif (isset($_POST['modifier_certif'])) { //verification de quelle bouton à était utilsé
    $req = $pdo->prepare("UPDATE certification SET description = ? WHERE id_certif=?"); //modification dans la BDD
    $req->execute([$_POST['nom'], $_POST['id']]);
    header('Location: index.php');
    exit();
} elseif (isset($_POST['supprimer_certif'])) { //verification de quelle bouton à était utilsé
    $req = $pdo->prepare("DELETE FROM certification WHERE certification.id_certif=?"); //Supression dans la BDD
    $req->execute([$_POST['id']]);
    header('Location: index.php');
    exit();
}
