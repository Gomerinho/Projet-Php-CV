<?php
require_once 'inc/db.php';
session_start();
$dossier = 'img/';
$fichier = basename($_FILES['img']['name']);
$taille_maxi = 100000000;
$taille = filesize($_FILES['img']['tmp_name']);
$extensions = array('.jpg', '.jpeg', '.png', '.gif');
$extension = strrchr($_FILES['img']['name'], '.');
//Début des vérifications de sécurité...
if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
    $erreur = 'Vous devez uploader une image de type jpg, jpeg, odt ou doc...';
}
if ($taille > $taille_maxi) {
    $erreur = 'Le fichier est trop gros...';
}
if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
    //On formate le nom du fichier
    $fichier = strtr(
        $fichier,
        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
    );
    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
    $rep = $dossier . "pdp" . $extension;
    if (move_uploaded_file($_FILES['img']['tmp_name'], $rep)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
    {
        $req = $pdo->prepare("UPDATE user SET img = ? WHERE id_user=?");
        $req->execute([$rep, "1"]);
        $_SESSION['flash']['success'] =  'Photo envoyé avec succès !';
        header('Location: admin.php');
    } else //Sinon (la fonction renvoie FALSE).
    {
        $erreur['upload'] =  "Echec de l'upload !";
    }
} else {
    $_SESSION['flash']['danger'] = $erreur;
    header('Location: admin.php');
}
