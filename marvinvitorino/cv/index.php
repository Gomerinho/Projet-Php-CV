<?php

require_once 'inc/db.php';
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
  <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css">

  <!-- Custom styles for this template -->
  <link href="css/resume.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
      <span class="d-block d-lg-none"><?php echo $utilisateur->prenom ?> <?php echo $utilisateur->nom ?></span>
      <span class="d-none d-lg-block">
        <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="<?php echo $utilisateur->img ?>" alt="">
      </span>
    </a>
    <button class=" navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#about">A Propos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#experience">Experience</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#education">Formation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#skills">Compétences</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#interests">Centres d'intérets</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#awards">Certifications</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="admin.php">Panneau de Contrôle</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container-fluid p-0">
    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="about">
      <div class="w-100">
        <h1 class="mb-0"><?php echo $utilisateur->prenom ?>
          <span class="text-primary"><?php echo $utilisateur->nom ?></span>
        </h1>
        <div class="subheading mb-5"><?php echo $utilisateur->adresse ?> · <?php echo $utilisateur->num ?> ·
          <a href="mailto:<?php echo $utilisateur->email ?>"><?php echo $utilisateur->email ?></a>
        </div>
        <p class="lead mb-5"><?php echo $utilisateur->bio ?></p>
        <div class="social-icons">
          <a href="http://<?php echo $utilisateur->linkedin ?>">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <a href="http://<?php echo $utilisateur->github ?>">
            <i class="fab fa-github"></i>
          </a>
          <a href="http://<?php echo $utilisateur->twitter ?>">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="http://<?php echo $utilisateur->fb ?>">
            <i class="fab fa-facebook-f"></i>
          </a>
        </div>
      </div>
    </section>

    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex justify-content-center" id="experience">
      <div class="w-100">
        <h2 class="mb-5">Experience professionnel</h2>
        <?php while ($experience = $resultat_exp->fetch(PDO::FETCH_OBJ)) :
          $date_debut = new DateTime($experience->date_debut);
        ?>

          <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
            <div class="resume-content">
              <h3 class="mb-0"><?php echo $experience->metier ?></h3>
              <div class="subheading mb-3"><?php echo $experience->entreprise ?></div>
              <p><?php echo $experience->description ?></p>
            </div>
            <div class="resume-date text-md-right">
              <span class="text-primary"><?php echo $date_debut->format('F Y'); ?> - <?php if (($experience->date_fin == NULL) or empty($experience->date_fin)) { //Si il n'y a pas de date de fin on affiche jusque ajd
                                                                                        $date_fin = date("F Y");
                                                                                        echo $date_fin;
                                                                                      } else {
                                                                                        $date_fin = new DateTime($experience->date_fin);
                                                                                        echo $date_fin->format('F Y');
                                                                                      } ?></span>
            </div>
          </div>
        <?php
        endwhile ?>
      </div>

    </section>
    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="education">
      <div class="w-100">
        <h2 class="mb-5">Formation</h2>
        <?php while ($formation = $resultat_forma->fetch(PDO::FETCH_OBJ)) {
          $date_debut = new DateTime($formation->date_debut);
          $date_fin = new DateTime($formation->date_fin); ?>
          <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
            <div class="resume-content">
              <h3 class="mb-0"><?php echo $formation->nom_univ ?></h3>
              <div class="subheading mb-3"><?php echo $formation->nom_diplome ?></div>
              <div><?php echo $formation->description ?></div>
            </div>
            <div class="resume-date text-md-right">
              <span class="text-primary"><?php echo $date_debut->format('F Y'); ?> - <?php if (($formation->date_fin == NULL) or empty($formation->date_fin)) { //Si il n'y a pas de date de fin on affiche jusque ajd
                                                                                        $date_fin = date("F Y");
                                                                                        echo $date_fin;
                                                                                      } else {
                                                                                        $date_fin = new DateTime($formation->date_fin);
                                                                                        echo $date_fin->format('F Y');
                                                                                      } ?></span>
            </div>
          </div>
        <?php } ?>
      </div>
    </section>

    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="skills">
      <div class="w-100">
        <h2 class="mb-5">Compétences</h2>

        <div class="subheading mb-3">Langages de Programation &amp; Outils</div>
        <ul class="list-inline dev-icons">
          <?php while ($langage = $resultat_langage->fetch(PDO::FETCH_OBJ)) : ?>
            <li class="list-inline-item">
              <i class="devicon-<?php echo $langage->nom ?>-plain"></i>
            </li>
          <?php endwhile ?>
        </ul>

        <div class="subheading mb-3">Workflow</div>
        <ul class="fa-ul mb-0">
          <?php while ($competence = $resultat_comp->fetch(PDO::FETCH_OBJ)) : ?>
            <li>
              <i class="fa-li fa fa-check"></i>
              <?php echo $competence->description ?></li>
          <?php endwhile ?>
        </ul>
      </div>
    </section>

    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="interests">
      <div class="w-100">
        <h2 class="mb-5">Centre d'intérêt</h2>
        <p><?php echo $interest->description ?></p>
      </div>
    </section>

    <hr class="m-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="awards">
      <div class="w-100">
        <h2 class="mb-5">Récompenses &amp; Certifications</h2>
        <ul class="fa-ul mb-0">
          <?php while ($certif = $resultat_certif->fetch(PDO::FETCH_OBJ)) : ?>
            <li>
              <i class="fa-li fa fa-trophy text-warning"></i>
              <?php echo $certif->nom ?></li>
          <?php endwhile ?>
      </div>
    </section>

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