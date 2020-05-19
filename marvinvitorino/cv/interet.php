<?php

require_once 'inc/db.php';

if (isset($_POST['modifier_int'])) {
    $req = $pdo->prepare("UPDATE interest SET description = ? WHERE id_interest=?");
    $req->execute([$_POST['description'], $_POST['id']]);
    header('Location: index.php');
    exit();
}
