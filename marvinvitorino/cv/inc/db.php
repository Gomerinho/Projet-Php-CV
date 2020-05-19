<?php

$pdo = new PDO('mysql:host=localhost;dbname=marvinvitorino', 'root', 'root');

$utilisateur = $pdo->query("SELECT * FROM user ")->fetch(PDO::FETCH_OBJ);

$resultat_exp = $pdo->query("SELECT * FROM experience");

$resultat_forma = $pdo->query("SELECT * FROM formation");

$resultat_interest = $pdo->query("SELECT * FROM interest");

$interest = $resultat_interest->fetch(PDO::FETCH_OBJ);

$resultat_langage = $pdo->query("SELECT * FROM langage_prog");

$resultat_comp = $pdo->query("SELECT * FROM competences");

$resultat_certif = $pdo->query("SELECT * FROM certification");
