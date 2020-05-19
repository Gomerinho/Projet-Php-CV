<?php

require_once 'inc/db.php';

if (isset($_POST['ajouter'])) {
    if (empty($_POST['date_fin'])) {
        $_POST['date_fin'] = NULL;
    } elseif (empty($_POST['description'])) {
        $_POST['description']  = NULL;
    }
    $req = $pdo->prepare("INSERT INTO experience SET entreprise = ?, metier = ?, description = ?, date_debut = ?, date_fin = ?");
    $req->execute([$_POST['nom_entreprise'], $_POST['metier'], $_POST['description'], $_POST['date_debut'], $_POST['date_fin']]);
    header('Location: index.php');
    exit();
} elseif (isset($_POST['modifier'])) {
    if (empty($_POST['date_fin'])) {
        $_POST['date_fin'] = NULL;
    } elseif (empty($_POST['description'])) {
        $_POST['description']  = NULL;
    }
    $req = $pdo->prepare("UPDATE experience SET entreprise = ?, metier = ?, description = ?, date_debut = ?, date_fin = ? WHERE id_exp=?");
    $req->execute([$_POST['nom_entreprise'], $_POST['metier'], $_POST['description'], $_POST['date_debut'], $_POST['date_fin'], $_POST['id']]);
    header('Location: index.php');
    exit();
} elseif (isset($_POST['supprimer'])) {
    $req = $pdo->prepare("DELETE FROM experience WHERE experience.id_exp=?");
    $req->execute([$_POST['id']]);
    header('Location: index.php');
    exit();
}
