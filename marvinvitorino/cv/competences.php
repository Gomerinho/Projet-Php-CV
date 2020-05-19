<?php
require_once 'inc/db.php';

if (isset($_POST['ajouter_comp'])) {
    $req = $pdo->prepare("INSERT INTO competences SET description = ?");
    $req->execute([$_POST['description']]);
    header('Location: index.php');
    exit();
} elseif (isset($_POST['modifier_comp'])) {
    $req = $pdo->prepare("UPDATE competences SET description = ? WHERE id_competences=?");
    $req->execute([$_POST['description'], $_POST['id']]);
    header('Location: index.php');
    exit();
} elseif (isset($_POST['supprimer_comp'])) {
    $req = $pdo->prepare("DELETE FROM competences WHERE competences.id_competences=?");
    $req->execute([$_POST['id']]);
    header('Location: index.php');
    exit();
}

if (isset($_POST['ajouter_lang'])) {
    $req = $pdo->prepare("INSERT INTO langage_prog SET nom = ?");
    $req->execute([$_POST['nom']]);
    header('Location: index.php');
    exit();
} elseif (isset($_POST['modifier_lang'])) {
    $req = $pdo->prepare("UPDATE langage_prog SET nom = ? WHERE id_langage=?");
    $req->execute([$_POST['nom'], $_POST['id']]);
    header('Location: index.php');
    exit();
} elseif (isset($_POST['supprimer_lang'])) {
    $req = $pdo->prepare("DELETE FROM langage_prog WHERE langage_prog.id_langage=?");
    $req->execute([$_POST['id']]);
    header('Location: index.php');
    exit();
}
