<?php
require_once "forms/condb.php"; // connexion PDO dans $pdo

$sql = "
SELECT 
    p.id,
    p.titre,
    p.contenu,
    p.image,
    p.date_publication,
    a.nom AS auteur
FROM posts p
JOIN admins a ON p.admin_id = a.id
WHERE p.statut = 'publie'
ORDER BY p.date_publication DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Blog FC</title>
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
            <a href="index.php">
              <i class="bi bi-box-arrow-right me-1"></i> Acceuil
            </a>
          </li>
          <li class="current">Les dernières actualités</li>
        </ol>
      </nav>

    

    </div>

    <!-- Titre -->
    <h1 class="mt-3">Les dernières actualités</h1>


  </div>
</div><!-- End Page Title -->


   <main class="main">

    <div class="container">


<div class="blog-grid">
<?php foreach ($posts as $post): ?>
<div
    class="cards-container"
    style="
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        width: 100%;
        padding: 40px;
        box-sizing: border-box;
        align-items: stretch;
    "
>
        

                <article
    class="blog-card"
    style="
        background: linear-gradient(180deg, #1c1c1c, #151515);
        border: 1px solid #2a2a2a;
        border-radius: 18px;
        width: 100%;
        max-width: 1000px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        color: #ffffff;
        font-family: Arial, sans-serif;
        overflow: hidden;
    "
>

    <!-- CONTENEUR 2 COLONNES -->
    <div
        style="
            display: grid;
            grid-template-columns: 35% 65%;
            min-height: 220px;
        "
    >

        <!-- COLONNE IMAGE -->
        <?php if (!empty($post['image']) && file_exists(__DIR__ . '/uploads/' . $post['image'])): ?>
        <div style="width:100%; height:100%; overflow:hidden;">
            <img
                src="uploads/<?= htmlspecialchars($post['image']) ?>"
                alt="<?= htmlspecialchars($post['titre']) ?>"
                style="
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                "
            >
        </div>
        <?php endif; ?>

        <!-- COLONNE TEXTE -->
        <div
            class="blog-content"
            style="
                padding: 30px 22px;
                text-align: left;
                display: flex;
                flex-direction: column;
                justify-content: center;
            "
        >
            <p class="blog-meta">
                Le <?= date('d/m/Y', strtotime($post['date_publication'])) ?>  
                — Par <?= htmlspecialchars($post['auteur']) ?>
            </p>

            <h3 class="blog-title">
                <?= htmlspecialchars($post['titre']) ?>
            </h3>

            <p class="blog-excerpt">
                <?= mb_substr(strip_tags($post['contenu']), 0, 150) ?>...
            </p>

            <a 
                href="artpart.php?id=<?= $post['id'] ?>" 
                class="btn-read"
                style="align-self: flex-start;"
            >
                Lire la suite
            </a>
        </div>

    </div>
</article>

 </div>

<?php endforeach; ?>
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
