<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Contacts - Francky SABITI TECH</title>
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
<body class="index-page">
     <header id="header" class="header d-flex align-items-center fixed-top">
 <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
         <h4 class="sitename">Francky SABITI</h4>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" >Acceuil</a></li>
          <li><a href="about.php">À propos</a></li>
          <li><a href="resume.php" >Carrière</a></li>
          <li><a href="services.php">Services</a></li>
          <li class="dropdown"><a href="#"><span>Réalisations</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
               <li><a href="SIG.php">Systèmes d’Information & Outils Internes</a></li>
              <li><a href="web.php">Développement Web</a></li>
              <li><a href="data.php">Analyses de Données</a></li>
              <li><a href="mobile.php">Applications Mobiles</a></li>
              <li><a href="log.php">Gestion d’Entrepôt & Logistique</a></li>
              <li><a href="ai.php">Nouvelles Technologies & Intelligence Artificielle</a></li>
            </ul>
          </li>
          <li><a href="contacts.php"class="active">Contact</a></li>
          <li><a href="login.php"><i class="bi bi-person-lock me-2"></i></a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="blogfc.php">Blog</a>

    </div>
  </header>

  <main class="main">
   
   <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span class="subtitle">Contact</span>
        <h2>Contact</h2>
        <p>Vous avez une question, un projet ou une collaboration à me proposer ?
N’hésitez pas à me contacter via le formulaire ci-dessous ou par e-mail.
Je serai heureux d’échanger avec vous et de répondre dans les plus brefs délais.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item">
              <div class="icon-wrapper">
                <i class="bi bi-geo-alt"></i>
              </div>
              <div>
                <h3>Address</h3>
                <p>Kolwezi, Lualaba RDCongo</p>
              </div>
            </div>

            <div class="info-item">
              <div class="icon-wrapper">
                <i class="bi bi-telephone"></i>
              </div>
              <div>
                <h3>Appelez-moi</h3>
                <p>+243 850 754 604</p>
              </div>
            </div>

            <div class="info-item">
              <div class="icon-wrapper">
                <i class="bi bi-envelope"></i>
              </div>
              <div>
                <h3>Email</h3>
                <p>contact@franckysabiti.com</p>
              </div>
            </div>

          </div>

          <div class="col-lg-8">
            <form action="contact.php" method="post" class="php-email-form">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="nom" class="form-control" placeholder="Votre nom" required="">
                </div>

                <div class="col-md-6">
                  <input type="email" class="form-control" name="email" placeholder="Votre e-mail" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="sujet" placeholder="Sujet" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Chargement</div>
                  <div class="error-message"></div>
                 <div class="sent-message">Votre message a été envoyé. Merci!</div>

                  <button type="submit">Envoyer</button>
                </div>

              </div>
            </form>
          </div>

        </div>

      </div>

    </section><!-- /Contact Section -->



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
