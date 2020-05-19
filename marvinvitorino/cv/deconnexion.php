<?php
session_start();

unset($_SESSION['auth']); //destruction de la sessions de l'utilisateur
header('Location: index.php');
exit();
