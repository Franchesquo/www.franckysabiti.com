<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Demarrer un projet</title>
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
            <li class="current">Demarrez un projet</li>
          </ol>
        </nav>
        <h1>Exprimez-vous paisiblement</h1>
      </div>
    </div><!-- End Page Title -->

    
<br>

<div class="container">

    <br>
            <div class="col-lg-12">
                  <form id="projetForm">
                    <div class="row gy-4">

                      <!-- Nom -->
                      <div class="col-md-6">
                        <input 
                          type="text" 
                          name="nom" 
                          class="form-control" 
                          placeholder="Votre nom" 
                          required
                        >
                      </div>

                      <!-- Email -->
                      <div class="col-md-6">
                        <input 
                          type="email" 
                          name="email" 
                          class="form-control" 
                          placeholder="Votre e-mail" 
                          required
                        >
                      </div>

                      <!-- Téléphone / WhatsApp -->
                      <div class="col-md-6">
                        <input 
                          type="text" 
                          name="telephone" 
                          class="form-control" 
                          placeholder="Téléphone / WhatsApp"
                        >
                      </div>

                      <!-- Type de projet -->
                      <div class="col-md-6">
                        <select 
                          name="type_projet" 
                          class="form-control" 
                          required
                        >
                          <option value="">Type de projet</option>
                          <option value="site_vitrine">Site vitrine</option>
                          <option value="blog">Blog / Média</option>
                          <option value="application_web">Application web</option>
                          <option value="application_mobile">Application mobile</option>
                          <option value="analyse_donnees">Analyse de données / BI</option>
                          <option value="seo">Référencement (SEO)</option>
                          <option value="identite_de_marque">Identité de marque</option>
                          <option value="developpement_desktop">Développement de logiciels Desktop</option>
                          <option value="ui_ux_design">Conception UI/UX</option>
                          <option value="marketing_numerique">Marketing numérique</option>
                          <option value="autre">Autre</option>
                        </select>
                      </div>

                      <!-- Budget -->
                      <div class="col-md-6">
                        <select 
                          name="budget" 
                          class="form-control"
                        >
                          <option value="">Budget estimatif</option>
                          <option value="moins_500">Moins de 500$</option>
                          <option value="500_1000">500$ – 1 000$</option>
                          <option value="1000_3000">1 000$ – 3 000$</option>
                          <option value="3000_plus">Plus de 3 000$</option>
                        </select>
                      </div>

                      <!-- Délai -->
                      <div class="col-md-6">
                        <select 
                          name="delai" 
                          class="form-control"
                        >
                          <option value="">Délai souhaité</option>
                          <option value="urgent">Urgent</option>
                          <option value="1_mois">Sous 1 mois</option>
                          <option value="1_3_mois">1 à 3 mois</option>
                          <option value="flexible">Flexible</option>
                        </select>
                      </div>

                      <!-- Description du projet -->
                      <div class="col-md-12">
                        <textarea 
                          class="form-control" 
                          name="description" 
                          rows="6" 
                          placeholder="Décrivez votre projet (objectifs, besoins, idées…)" 
                          required
                        ></textarea>
                      </div>

                      <!-- Messages système + bouton -->
                      <div class="col-md-12 text-center">
                       
                        

                        <button type="submit" class="btn btn-primary px-4" >
                          Envoyer la demande
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
   <!--<script src="assets/vendor/php-email-form/validate.js"></script>-->
   <script src="assets/vendor/php-email-form/projet-form.js"></script>
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
