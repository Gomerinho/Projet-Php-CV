<?php

require_once 'inc/db.php';

if (isset($_POST['ajouter_forma'])) {
    if (empty($_POST['date_fin'])) {
        $_POST['date_fin'] = NULL;
    } elseif (empty($_POST['description'])) {
        $_POST['description']  = NULL;
    }
    $req = $pdo->prepare("INSERT INTO formation SET nom_univ = ?, nom_diplome = ?, description = ?, date_debut = ?, date_fin = ?");
    $req->execute([$_POST['nom_univ'], $_POST['nom_diplome'], $_POST['description'], $_POST['date_debut'], $_POST['date_fin']]);
    header('Location: index.php');
    exit();
} elseif (isset($_POST['modifier_forma'])) {
    if (empty($_POST['date_fin'])) {
        $_POST['date_fin'] = NULL;
    } elseif (empty($_POST['description'])) {
        $_POST['description']  = NULL;
    }
    $req = $pdo->prepare("UPDATE formation SET nom_univ = ?, nom_diplome = ?, description = ?, date_debut = ?, date_fin = ? WHERE id_forma=?");
    $req->execute([$_POST['nom_univ'], $_POST['nom_diplome'], $_POST['description'], $_POST['date_debut'], $_POST['date_fin'], $_POST['id']]);
    header('Location: index.php');
    exit();
} elseif (isset($_POST['supprimer_forma'])) {
    $req = $pdo->prepare("DELETE FROM formation WHERE formation.id_forma=?");
    $req->execute([$_POST['id']]);
    header('Location: index.php');
    exit();
}
