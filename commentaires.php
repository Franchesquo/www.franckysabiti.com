<?php
session_start();
require_once 'forms/condb.php';

// Sécurité : admin connecté ?
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$sql = "
SELECT 
    c.id,
    c.nom,
    c.email,
    c.commentaire,
    c.date_commentaire,
    c.statut,
    p.titre AS article
FROM commentaires c
JOIN posts p ON c.post_id = p.id
ORDER BY c.date_commentaire DESC
";

$stmt = $pdo->query($sql);
$commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);

//APPROUVER UN COMMENTAIRE

if (isset($_GET['approve']) && is_numeric($_GET['approve'])) {

    $id = (int) $_GET['approve'];

    $sql = "UPDATE commentaires SET statut = 'approuve' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    header('Location: commentaires.php');
    exit;
}

//SUPPRIMER UN COMMENTAIRE
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {

    $id = (int) $_GET['delete'];

    $sql = "DELETE FROM commentaires WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    header('Location: commentaires.php');
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Gestions commentaires</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon11.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">



  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Craftivo
  * Template URL: https://bootstrapmade.com/craftivo-bootstrap-portfolio-template/
  * Updated: Oct 04 2025 with Bootstrap v5.3.8
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>
 <main class="main">
 

<div class="page-title light-background">
  <div class="container">

    <!-- Ligne du haut -->
    <div class="d-flex align-items-center">
      
      <!-- Breadcrumbs à gauche -->
      <nav class="breadcrumbs">
        <ol class="mb-0">
          <li>
            <a href="men.php">
             Menu
            </a>
          </li>
          <li class="current"> Commentaires</li>
        </ol>
      </nav>

    

    </div>

    <!-- Titre -->
    <h1 class="mt-3"> Commentaires</h1>


  </div>
</div><!-- End Page Title -->


<main class="main">
<div class="container">
        <br>

        <h2>Gestion des commentaires</h2>

<table border="1" cellpadding="10" width="100%" class="table table-dark table-striped table-hover align-middle" style="font-size: 12px;">
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Commentaire</th>
        <th>Article</th>
        <th>Date</th>
        <th>Statut</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($commentaires as $com): ?>
        <tr>
            <td><?= htmlspecialchars($com['nom']) ?></td>
            <td><?= htmlspecialchars($com['email']) ?></td>
            <td><?= nl2br(htmlspecialchars($com['commentaire'])) ?></td>
            <td><?= htmlspecialchars($com['article']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($com['date_commentaire'])) ?></td>
            <td><?= $com['statut'] ?></td>
            <td style="text-align: center;">

    <?php if ($com['statut'] === 'en_attente'): ?>
        <a 
            href="?approve=<?= $com['id'] ?>" 
            title="Approuver"
            style="color: #28a745; margin-right: 12px;"
        >
            Valider
        </a>
    <?php endif; ?>

    <a 
        href="?delete=<?= $com['id'] ?>" 
        title="Supprimer"
        onclick="return confirm('Supprimer ce commentaire ?')"
        style="color: #dc3545;"
    >
        Supprimer
    </a>

</td>

        </tr>
    <?php endforeach; ?>
</table>




</div>
   
    <br>

 <?php include("pied.php"); ?>
 </main>
<!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="assets/vendor/php-email-form/validate.js"></script>-->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/typed.js/typed.umd.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>
