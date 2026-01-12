
<?php
session_start();
require_once "forms/condb.php";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];

    $sql = "SELECT * FROM admins WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);

    $admin = $stmt->fetch();

    if ($admin && password_verify($mot_de_passe, $admin['mot_de_passe'])) {

        // Connexion réussie
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_nom'] = $admin['nom'];

        header("Location: men.php");
        exit;

    } else {
         header("Location: login.php?error=1");
    exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Connexion administrateur</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon11.png" rel="icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


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
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Accueil</a></li>
            <li class="current">Connexion administrateurs</li>
          </ol>
        </nav>
        <h1>Cette section est reservée juste aux administrateurs du site</h1>
      </div>
    </div><!-- End Page Title -->

    
<br>

<div class="container">
            <div class="col-lg-8 order-lg-1 mx-auto">
                <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger text-center mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        Email ou mot de passe incorrect
    </div>
<?php endif; ?>

                        <form method="post" action="">
    <div class="row gy-4">

        <!-- Email -->
        <div class="col-md-8">
            <label class="form-label">Email :</label>
            <input 
                type="email"
                name="email"
                class="form-control"
                placeholder="Entrez votre E-mail"
                required
            >
        </div>

        <!-- Mot de passe avec icône œil -->
        <div class="col-md-8">
            <label class="form-label">Mot de passe :</label>

            <div class="input-group">
                <input 
                    type="password"
                    name="mot_de_passe"
                    id="mot_de_passe"
                    class="form-control"
                    placeholder="Entrez votre Mot de passe"
                    required
                >

                <span class="input-group-text" id="togglePassword" style="cursor:pointer;">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                </span>
            </div>
        </div>

        <!-- Bouton connexion -->
        <div class="col-md-12 d-flex  gap-3">
    <button class="btn btn-primary px-4" type="submit" name="login">
        <i class="bi bi-box-arrow-in-right me-2"></i>
        Se connecter
    </button>

    <button class="btn btn-success px-4" type="reset">
        <i class="bi bi-x-circle me-2"></i>
        Effacer
    </button>
</div>


    </div>
</form>

             </div>
 </div>

<br><br>


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

  <script>
const passwordInput = document.getElementById('mot_de_passe');
const togglePassword = document.getElementById('togglePassword');
const eyeIcon = document.getElementById('eyeIcon');

togglePassword.addEventListener('click', function () {
    const isPassword = passwordInput.type === 'password';

    passwordInput.type = isPassword ? 'text' : 'password';

    eyeIcon.classList.toggle('bi-eye');
    eyeIcon.classList.toggle('bi-eye-slash');
});
</script>


</body>

</html>
