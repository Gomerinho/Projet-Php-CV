<?php

require_once 'inc/db.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['auth'])) {
    $_SESSION['flash']['warning'] = "Vous devez vous connecter pour accéder a cette page";
    header('Location: login.php');
    exit();
}

if (!empty($_POST)) {
    $req = $pdo->prepare('UPDATE user SET nom =?, prenom =?, adresse =?,num =?,bio =?,email =?,fb =?,twitter =?,linkedin =?,github =?  WHERE id_user=?');
    $req->execute([$_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['num'], $_POST['bio'], $_POST['email'], $_POST['fb'], $_POST['tw'], $_POST['li'], $_POST['git'], "1"]);
    header('Location: index.php');
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

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Panneau de controle</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#info">Information Personnelle <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Expériences
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#modif_exp">Modifier</a>
                        <a class="dropdown-item" href="#modif_exp">Supprimer</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#ajouter_exp">Ajouter une expérience</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Formations
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#modif_forma">Modifier</a>
                        <a class="dropdown-item" href="#modif_forma">Supprimer</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#ajouter_forma">Ajouter une formation</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Compétences
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#modif_comp">Modifier</a>
                        <a class="dropdown-item" href="#modif_comp">Supprimer</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#ajouter_comp">Ajouter une formation</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#ajouter_lang">Ajouter un langage de programmation</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#ci">Centre d'interêt</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Certifications
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#modif_certif">Modifier</a>
                        <a class="dropdown-item" href="#modif_certif">Supprimer</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#ajouter_certif">Ajouter une Certification</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">CV</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="deconnexion.php">Deconnexion</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <?php if (isset($_SESSION['flash'])) : ?>
            <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                <div class="alert alert-<?= $type ?> " style="margin-top: 10%;width : 50%;">
                    <?= $message; ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif ?>
        <h2 style="margin: 5% 0 5% 0" id="info">Information Personnelle</h2>
        <form method="POST" action="img.php" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
            </div>
            <div class="form-group">
                <label> <img class="rounded mx-auto d-block" src="<?php echo $utilisateur->img ?>" alt="" width="100" height="100"></label>
                <input type="file" name="img">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit"> Changer la photo</button>
            </div>
        </form>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Nom</label>
                    <input name="nom" type="text" class="form-control" id="inputEmail4" placeholder="Nom" value="<?php echo $utilisateur->nom ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Prénom</label>
                    <input name="prenom" type="text" class="form-control" id="inputPassword4" placeholder="Prénom" value="<?php echo $utilisateur->prenom ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input name="email" type="email" class="form-control" id="inputEmail4" placeholder="Email" value="<?php echo $utilisateur->email ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Téléphone</label>
                    <input name="num" type="text" class="form-control" id="inputPassword4" placeholder="Password" value="<?php echo $utilisateur->num ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Adresse</label>
                <input name="adresse" type="text" class="form-control" id="inputAddress" placeholder="3 rue des ..." value="<?php echo $utilisateur->adresse ?>">
            </div>
            <div class="form-group">
                <label for="inputAddress">Facebook</label>
                <input name="fb" type="text" class="form-control" id="inputAddress" placeholder="Facebook" value="<?php echo $utilisateur->fb ?>">
            </div>
            <div class="form-group">
                <label for="inputAddress">Twitter</label>
                <input name="tw" type="text" class="form-control" id="inputAddress" placeholder="Twitter" value="<?php echo $utilisateur->twitter ?>">
            </div>
            <div class="form-group">
                <label for="inputAddress">LinkedIn</label>
                <input name="li" type="text" class="form-control" id="inputAddress" placeholder="LinkedIn" value="<?php echo $utilisateur->linkedin ?>">
            </div>
            <div class="form-group">
                <label for="GitHub">GitHub</label>
                <input name="git" type="text" class="form-control" id="GitHub" placeholder="GitHub" value="<?php echo $utilisateur->github ?>">
            </div>
            <div class="form-group">
                <label for="">Bio</label>
                <textarea name="bio" class="form-control" placeholder="Biographie"><?php echo $utilisateur->bio ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
        <h2 style="margin: 5% 0 5% 0" id="modif_exp">Expérience</h2>
        <?php while ($experience = $resultat_exp->fetch(PDO::FETCH_OBJ)) : ?>
            <div class="card" style="margin: 5% 0 5% 0">
                <div class="card-body">
                    <form action="experience.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputMetier">Métier</label>
                                <input name="metier" type="text" class="form-control" id="inputMetier" placeholder="Metier" value="<?php echo $experience->metier ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEntreprise">Nom de l'entreprise</label>
                                <input name="nom_entreprise" type="text" class="form-control" id="inputEntreprise" placeholder="Entreprise" value="<?php echo $experience->entreprise ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="inputDesc">Description de l'employe</label>
                                <textarea name="description" id="inputDesc" cols="100" rows="0"><?php echo $experience->description ?></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputDateDebut">Début de l'emploie</label>
                                <input type="date" name="date_debut" id="inputDateDebut" value="<?php echo $experience->date_debut ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputDateFin">Fin de l'emploie</label>
                                <input type="date" name="date_fin" id="inputDateFin" value="<?php echo $experience->date_fin ?>">
                                <input type="hidden" name="id" value="<?php echo $experience->id_exp ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-large btn-block btn-primary" name="modifier">Modifier</button>

                        <button type="submit" class="btn btn-large btn-block btn-danger" name="supprimer">Supprimer</button>

                    </form>
                </div>
            </div>
        <?php endwhile ?>
        <div class="card" style="margin: 5% 0 5% 0">
            <div class="card-body">
                <h4 id="ajouter_exp">Ajouter un nouveau métier</h4>
                <form action="experience.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputMetier">Métier</label>
                            <input name="metier" type="text" class="form-control" id="inputMetier" placeholder="Metier" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEntreprise">Nom de l'entreprise</label>
                            <input name="nom_entreprise" type="text" class="form-control" id="inputEntreprise" placeholder="Entreprise" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="inputDesc">Description de l'employe</label>
                            <textarea name="description" id="inputDesc" cols="100" rows="0"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="inputDateDebut">Début de l'emploie</label>
                            <input type="date" name="date_debut" id="inputDateDebut" value="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputDateFin">Fin de l'emploie</label>
                            <input type="date" name="date_fin" id="inputDateFin" value="NULL">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-large btn-block btn-success" name="ajouter">Ajouter</button>
                </form>
            </div>
        </div>
        <h2 style="margin: 5% 0 5% 0" id="modif_forma">Formation</h2>
        <?php while ($formation = $resultat_forma->fetch(PDO::FETCH_OBJ)) : ?>
            <div class="card" style="margin: 5% 0 5% 0">
                <div class="card-body">
                    <form action="formation.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputDiplome">Nom du Diplome</label>
                                <input name="nom_diplome" type="text" class="form-control" id="inputDiplome" placeholder="Diplome" value="<?php echo $formation->nom_diplome ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputUniv">Nom de l'université</label>
                                <input name="nom_univ" type="text" class="form-control" id="inputUniv" placeholder="université" value="<?php echo $formation->nom_univ ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="inputDesc">Description de la formation</label>
                                <textarea name="description" id="inputDesc" cols="100" rows="0"><?php echo $formation->description ?></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputDateDebut">Début de la formation</label>
                                <input type="date" name="date_debut" id="inputDateDebut" value="<?php echo $formation->date_debut ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputDateFin">Fin de la formation</label>
                                <input type="date" name="date_fin" id="inputDateFin" value="<?php echo $formation->date_fin ?>">
                                <input type="hidden" name="id" value="<?php echo $formation->id_forma ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-large btn-block btn-primary" name="modifier_forma">Modifier</button>

                        <button type="submit" class="btn btn-large btn-block btn-danger" name="supprimer_forma">Supprimer</button>

                    </form>
                </div>
            </div>
        <?php endwhile ?>
        <div class="card" style="margin: 5% 0 5% 0">
            <div class="card-body">
                <h4 id="ajouter_forma">Ajouter une nouvelle formation</h4>
                <form action="formation.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputDiplome">Nom du Diplome</label>
                            <input name="nom_diplome" type="text" class="form-control" id="inputDiplome" placeholder="Diplome" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputUniv">Nom de l'université</label>
                            <input name="nom_univ" type="text" class="form-control" id="inputUniv" placeholder="Université / Ecole " value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="inputDesc">Description de la formation</label>
                            <textarea name="description" id="inputDesc" cols="100" rows="0"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="inputDateDebut">Début de la formation</label>
                            <input type="date" name="date_debut" id="inputDateDebut" value="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputDateFin">Fin de la formation</label>
                            <input type="date" name="date_fin" id="inputDateFin" value="NULL">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-large btn-block btn-success" name="ajouter_forma">Ajouter</button>
                </form>
            </div>
        </div>
        <h2 id="modif_comp" style="margin-top: 5%;margin-bottom : 5%;">Compétences</h2>
        <?php while ($competence = $resultat_comp->fetch(PDO::FETCH_OBJ)) : ?>
            <div class="card">
                <div class="card-body">
                    <form action="competences.php" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="inputDesc">Description de la compétence</label>
                                <input name="descrition" type="text" class="form-control" id="inputDesc" placeholder="Description" value="<?php echo $competence->description ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-small btn-primary" name="modifier_comp">Modifier</button>
                        <button type="submit" class="btn btn-small btn-danger" name="supprimer_comp">Supprimer</button>
                    </form>
                </div>
            </div>
        <?php endwhile ?>
        <div class="card" style="margin: 5% 0 5% 0">
            <div class="card-body">
                <h4 id="ajouter_comp">Ajouter une nouvelle compétence</h4>
                <form action="competences.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="inputDesc">Descrition de la compétence</label>
                            <input name="description" type="text" class="form-control" id="inputDesc" placeholder="descrition" value="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-large btn-block btn-success" name="ajouter_comp">Ajouter</button>
                </form>
            </div>
        </div>
        <?php while ($langage = $resultat_langage->fetch(PDO::FETCH_OBJ)) : ?>
            <div class="card" style="margin: 5% 0 5% 0">
                <div class="card-body">
                    <form action="competences.php" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="inputLang"> Langage : <span class="fab fa-<?php echo $langage->nom ?>"></span></label>
                                <select class="form-control" id="ControlSelect1" name="nom" area-placeholder="<?php echo $langage->nom ?>">
                                    <option value="<?php echo $langage->nom ?>"><?php echo $langage->nom ?></option>
                                    <option value="html5">HTML 5</option>
                                    <option value="css3">CSS3</option>
                                    <option value="javascript">JavaScript</option>
                                    <option value=python">Python</option>
                                    <option value="php">Php</option>
                                    <option value="mysql">SQL</option>
                                    <option value="react">React</option>
                                    <option value="angularjs">Angular</option>
                                    <option value="git">Git</option>
                                    <option value="laravel">Laravel</option>
                                    <option value="symfony">Symfony</option>
                                    <option value="django">Django</option>
                                    <option value="c">C</option>
                                    <option value="cplusplus">C++</option>
                                    <option value="csharp">C#</option>
                                    <option value="less">Less</option>
                                    <option value="sass">Sass</option>
                                    <option value="ruby">Ruby</option>
                                </select>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $langage->id_langage ?>">
                        </div>

                        <button type="submit" class="btn btn-small btn-primary" name="modifier_lang">Modifier</button>
                        <button type="submit" class="btn btn-small btn-danger" name="supprimer_lang"><span class="fa fa-trash"></span></button>
                    </form>
                </div>
            </div>
        <?php endwhile ?>
        <div class="card" style="margin: 5% 0 5% 0">
            <div class="card-body">
                <h4 id="ajouter_lang">Ajouter un nouveau langage de programmation</h4>
                <form action="competences.php" method="post">
                    <div class="form-group">
                        <label for="ControlSelect1">Langages de Programmation</label>
                        <select class="form-control" id="ControlSelect1" name="nom">
                            <option value="html5">HTML 5</option>
                            <option value="css3">CSS3</option>
                            <option value="javascript">JavaScript</option>
                            <option value="python">Python</option>
                            <option value="php">Php</option>
                            <option value="mysql">SQL</option>
                            <option value="react">React</option>
                            <option value="angularjs">Angular</option>
                            <option value="git">Git</option>
                            <option value="laravel">Laravel</option>
                            <option value="symfony">Symfony</option>
                            <option value="django">Django</option>
                            <option value="c">C</option>
                            <option value="cplusplus">C++</option>
                            <option value="csharp">C#</option>
                            <option value="less">Less</option>
                            <option value="sass">Sass</option>
                            <option value="ruby">Ruby</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-large btn-block btn-success" name="ajouter_lang">Ajouter</button>
                </form>
            </div>
        </div>
        <h2 id="ci">Centre d'intérêt</h2>
        <div class="card">
            <div class="card-body">
                <form action="interet.php" method="post">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="inputDesc">Centres d'intérêt</label>
                            <textarea name="description" id="inputDesc" cols="100" rows="3"><?php echo $interest->description ?></textarea>
                            <input type="hidden" name="id" value="<?php echo $interest->id_interest ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-small btn-block btn-primary" name="modifier_int">Modifier</button>
                </form>
            </div>
        </div>
        <h2 id="modif_certif">Certification</h2>
        <?php while ($certif = $resultat_certif->fetch(PDO::FETCH_OBJ)) : ?>
            <div class="card">
                <div class="card-body">
                    <form action="certification.php" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="inputLang">Certification : </label>
                                <input name="nom" type="text" class="form-control" id="inputLang" placeholder="Certification ou Récompense" value="<?php echo $certif->nom ?>">
                                <input type="hidden" name="id" value="<?php echo $certif->id_certif ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-small btn-primary" name="modifier_lang">Modifier</button>
                        <button type="submit" class="btn btn-small btn-danger" name="supprimer_lang"><span class="fa fa-trash"></span></button>
                    </form>
                </div>
            </div>
        <?php endwhile ?>
        <div class="card" style="margin: 5% 0 5% 0">
            <div class="card-body">
                <h4 id="ajouter_certif">Ajouter une Certification</h4>
                <form action="certif.php" method="post">
                    <div class="form-group">
                        <label for="input1">Certifications</label>
                        <input type="text" name="nom" id="input1" value="">
                        <button type="submit" class="btn btn-large btn-block btn-success" name="ajouter_certif">Ajouter</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/resume.min.js"></script>

</body>

</html>