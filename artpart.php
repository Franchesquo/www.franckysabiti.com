<?php
require_once 'forms/condb.php'; // connexion PDO

/* =========================
   1. VALIDATION DE L’ID
========================= */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Article invalide');
}

$id = (int) $_GET['id'];

/* =========================
   2. TRAITEMENT DU COMMENTAIRE
========================= */
if (isset($_POST['submit_comment'])) {

    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $commentaire = trim($_POST['commentaire']);
    $post_id = (int) $_POST['post_id'];

    if ($nom && $email && $commentaire) {

        $sqlInsert = "
        INSERT INTO commentaires 
            (post_id, nom, email, commentaire, date_commentaire, statut)
        VALUES 
            (:post_id, :nom, :email, :commentaire, NOW(), 'en_attente')
        ";

        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->execute([
            'post_id' => $post_id,
            'nom' => $nom,
            'email' => $email,
            'commentaire' => $commentaire
        ]);

        $message_commentaire = "Merci ! Votre commentaire est en attente de validation.";
    }
}

/* =========================
   3. RÉCUPÉRER L’ARTICLE
========================= */
$sql = "
SELECT 
    p.titre,
    p.contenu,
    p.image,
    p.date_publication,
    a.nom AS auteur,
    c.nom AS categorie
FROM posts p
JOIN admins a 
    ON p.admin_id = a.id
JOIN categories c 
    ON p.categorie_id = c.id
WHERE p.id = :id 
  AND p.statut = 'publie'
LIMIT 1
";

$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die('Article introuvable');
}

/* =========================
   4. RÉCUPÉRER LES COMMENTAIRES APPROUVÉS
========================= */
$sqlComments = "
SELECT 
    nom,
    commentaire,
    date_commentaire
FROM commentaires
WHERE post_id = :post_id
  AND statut = 'approuve'
ORDER BY date_commentaire ASC
";

$stmtComments = $pdo->prepare($sqlComments);
$stmtComments->execute(['post_id' => $id]);
$commentaires = $stmtComments->fetchAll(PDO::FETCH_ASSOC);

/* =========================
   4. TRAITEMENT PHP DU COMMENTAIRE (INSERTION)
========================= */

if (isset($_POST['submit_comment'])) {

    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $commentaire = trim($_POST['commentaire']);
    $post_id = (int) $_POST['post_id'];

    if ($nom && $email && $commentaire) {

        $sqlInsert = "
        INSERT INTO commentaires 
            (post_id, nom, email, commentaire, date_commentaire, statut)
        VALUES 
            (:post_id, :nom, :email, :commentaire, NOW(), 'en_attente')
        ";

        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->execute([
            'post_id' => $post_id,
            'nom' => $nom,
            'email' => $email,
            'commentaire' => $commentaire
        ]);

        // REDIRECTION POUR ÉVITER LES DOUBLONS
        header("Location: artpart.php?id=" . $post_id . "&comment=success");
        exit;
    }
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Affichage</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Open Graph pour WhatsApp / Facebook -->
<meta property="og:title" content="<?= htmlspecialchars($post['titre']) ?>">
<meta property="og:description" content="<?= mb_substr(strip_tags($post['contenu']), 0, 150) ?>">
<meta property="og:type" content="article">
<meta property="og:url" content="https://www.franckysabiti.com/artpart.php?id=<?= $id ?>">

<meta property="og:image" content="https://www.franckysabiti.com/uploads/<?= $post['image'] ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<meta property="og:site_name" content="Francky Sabiti Blog">


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
            <a href="blogfc.php">
             Blog
            </a>
          </li>
          <li class="current"> <?= htmlspecialchars($post['categorie']) ?></li>
        </ol>
      </nav>

    

    </div>

    <!-- Titre -->
    <h1 class="mt-3"> <?= htmlspecialchars($post['titre']) ?></h1>


  </div>
</div><!-- End Page Title -->


   <main class="main">
    <div class="container">
        <br>
<!------------------------Image de couverture------------ -->
    <?php if (!empty($post['image']) && file_exists(__DIR__ . '/uploads/' . $post['image'])): ?>
        <div style="
            width: 100%;
            aspect-ratio: 16 / 9;
            overflow: hidden;
            border-radius: 20px;
            margin-bottom: 30px;
        ">
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

 <!--------------------- Contenu  de l'articles----------->
            <div style="
                max-width: 100%;
                margin: 0 auto;
                padding: 20px;
                color: #ffffff;
            ">
                            <p style="color:#bdbdbd;">
                    Le <?= date('d/m/Y', strtotime($post['date_publication'])) ?>
                    — Par <?= htmlspecialchars($post['auteur']) ?>
                </p>

                <h1 style="
                    margin: 20px 0;
                    font-size: 36px;
                ">
                    <?= htmlspecialchars($post['titre']) ?>
                </h1>

                <div style="
                    line-height: 1.8;
                    font-size: 18px;
                    color: #e0e0e0;
                ">
                    <?= nl2br(htmlspecialchars($post['contenu'])) ?>
                </div>
            </div>


<br><br><br>

            <h3>Commentaires</h3>

<?php if (count($commentaires) === 0): ?>
    <p>Aucun commentaire pour le moment.</p>
<?php else: ?>
    <?php foreach ($commentaires as $com): ?>
        <div style="margin-bottom:20px; padding-bottom:10px; border-bottom:1px solid #333;">
            <strong><?= htmlspecialchars($com['nom']) ?></strong>
            <small style="color:#aaa;">
                — <?= date('d/m/Y H:i', strtotime($com['date_commentaire'])) ?>
            </small>

            <p><?= nl2br(htmlspecialchars($com['commentaire'])) ?></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>


<?php if (isset($_GET['comment']) && $_GET['comment'] === 'success'): ?>
    <p style="color: green;">
        Merci ! Votre commentaire est en attente de validation.
    </p>
<?php endif; ?>


<h3>Laisser un commentaire</h3>

<form method="post">
    <input type="hidden" name="post_id" value="<?= $id ?>">

    <div>
        <label>Nom</label><br>
        <input type="text" name="nom" required>
    </div>

    <div>
        <label>Email</label><br>
        <input type="email" name="email" required>
    </div>

    <div>
        <label>Commentaire</label><br>
        <textarea name="commentaire" rows="5" required></textarea>
    </div>

    <button type="submit" name="submit_comment">
        Envoyer
    </button>
</form>



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
