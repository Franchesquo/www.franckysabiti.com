<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>MENU PRINCIPAL</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon11.png" rel="icon">

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
 
 <!-- SESSION ADMIN --> 
    <?php
session_start();

// Sécurité : bloquer l’accès si non connecté
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// Nombre total de catégories
require_once "forms/condb.php";
$totalPosts = $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
$totalCategories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();


?>



<div class="page-title light-background">
  <div class="container">

    <!-- Ligne du haut -->
    <div class="d-flex align-items-center">
      
      <!-- Breadcrumbs à gauche -->
      <nav class="breadcrumbs">
        <ol class="mb-0">
          <li>
            <a href="logout.php">
              <i class="bi bi-box-arrow-right me-1"></i> Déconnecter
            </a>
          </li>
          <li class="current">MENU PRINCIPAL</li>
        </ol>
      </nav>

      <!-- Nom utilisateur à droite -->
      <p class="ms-auto mb-0 fw-semibold">
        <i class="bi bi-person-fill me-1"></i>
        <?php echo htmlspecialchars($_SESSION['admin_nom']); ?>
      </p>

    </div>

    <!-- Titre -->
    <h1 class="mt-3">MENU PRINCIPAL</h1>


  </div>
</div><!-- End Page Title -->


   <main class="main">

    <div class="container">

        

        <br>


    <div class="container my-5">
  <div class="row g-4">

    <!-- Gestion des articles -->
    <div class="col-md-4">
      <a href="articles.php" class="text-decoration-none">
        <div class="card dashboard-card bg-success text-white text-center">
          <div class="card-body">
            <div class="icon-circle">
              <i class="bi bi-file-earmark-text"></i>
            </div>
            <h5 class="mt-3">Gestion des articles</h5>
          </div>
        </div>
      </a>
    </div>

    <!-- Gestion des commentaires -->
    <div class="col-md-4">
      <a href="commentaires.php" class="text-decoration-none">
        <div class="card dashboard-card bg-warning text-white text-center">
          <div class="card-body">
            <div class="icon-circle">
              <i class="bi bi-chat-dots"></i>
            </div>
            <h5 class="mt-3">Gestion des commentaires</h5>
          </div>
        </div>
      </a>
    </div>

    <!-- Nombre total de posts -->
   <div class="col-md-4">
  <div class="card dashboard-card bg-primary text-white text-center">
    <div class="card-body">
      <div class="icon-circle">
        <i class="bi bi-tags"></i>
      </div>

      <h5 class="mt-3">Total des posts</h5>

      <h2 class="fw-bold mt-2">
        <?php echo $totalPosts; ?>
      </h2>
    </div>
  </div>
</div>


    <!-- Gestion des catégories -->
    <div class="col-md-4">
      <a href="add_category.php" class="text-decoration-none">
        <div class="card dashboard-card bg-danger text-white text-center">
          <div class="card-body">
            <div class="icon-circle">
              <i class="bi bi-tags"></i>
            </div>
            <h5 class="mt-3">Gestion des catégories</h5>
          </div>
        </div>
      </a>
    </div>

  </div>
</div>

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
