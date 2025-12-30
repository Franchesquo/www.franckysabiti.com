<?php
session_start();

/* =========================
   SÉCURITÉ
========================= */
if (!isset($_SESSION['admin_id'])) {
    header("Location: /login.php");
    exit;
}

require_once "forms/condb.php";

/* =========================
   CHARGER LES CATÉGORIES
========================= */
$categories = $pdo->query("
    SELECT id, nom FROM categories ORDER BY nom ASC
")->fetchAll(PDO::FETCH_ASSOC);

/* =========================
   MODE ÉDITION (PRÉ-REMPLISSAGE)
========================= */
$editPost = null;

if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->execute(['id' => (int)$_GET['edit']]);
    $editPost = $stmt->fetch(PDO::FETCH_ASSOC);
}

/* =========================
   AJOUT D’ARTICLE
========================= */
if (isset($_POST['add_post'])) {

    $titre        = trim($_POST['titre']);
    $contenu      = trim($_POST['contenu']);
    $categorie_id = (int) $_POST['categorie_id'];
    $statut       = $_POST['statut'];
    $admin_id     = $_SESSION['admin_id'];

    // Génération du slug
    $slug = strtolower($titre);
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');

   // Upload image
$imageName = null;

if (!empty($_FILES['image']['name'])) {

    if (!is_dir(__DIR__ . '/uploads')) {
        mkdir(__DIR__ . '/uploads', 0777, true);
    }

    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($ext, $allowed)) {
        die('Format image non autorisé');
    }

    $imageName = uniqid('post_') . '.' . $ext;

    if (!move_uploaded_file(
        $_FILES['image']['tmp_name'],
        __DIR__ . "/uploads/" . $imageName
    )) {
        die('Échec du déplacement du fichier image');
    }
}


    // Insertion
    $stmt = $pdo->prepare("
        INSERT INTO posts 
        (titre, slug, image, contenu, categorie_id, admin_id, statut, date_publication)
        VALUES 
        (:titre, :slug, :image, :contenu, :categorie_id, :admin_id, :statut, NOW())
    ");

    $stmt->execute([
        'titre'        => $titre,
        'slug'         => $slug,
        'image'        => $imageName,
        'contenu'      => $contenu,
        'categorie_id' => $categorie_id,
        'admin_id'     => $admin_id,
        'statut'       => $statut
    ]);

    header("Location: articles.php?success=1");
    exit;
}

/* =========================
   MODIFICATION D’ARTICLE
========================= */
if (isset($_POST['update_post'])) {

    $id           = (int) $_POST['id'];
    $titre        = trim($_POST['titre']);
    $contenu      = trim($_POST['contenu']);
    $categorie_id = (int) $_POST['categorie_id'];
    $statut       = $_POST['statut'];

    // Génération du slug
    $slug = strtolower($titre);
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');

    // Mise à jour
    $stmt = $pdo->prepare("
        UPDATE posts SET
            titre = :titre,
            slug = :slug,
            contenu = :contenu,
            categorie_id = :categorie_id,
            statut = :statut
        WHERE id = :id
    ");

    $stmt->execute([
        'titre'        => $titre,
        'slug'         => $slug,
        'contenu'      => $contenu,
        'categorie_id' => $categorie_id,
        'statut'       => $statut,
        'id'           => $id
    ]);

    header("Location: articles.php?updated=1");
    exit;
}

/* =========================
   SUPPRESSION D’ARTICLE
========================= */
if (isset($_POST['delete_post'])) {

    $id = (int) $_POST['post_id'];

    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->execute(['id' => $id]);

    header("Location: articles.php?deleted=1");
    exit;
}

/* =========================
   LISTE DES ARTICLES
========================= */
$articles = $pdo->query("
    SELECT 
        posts.id,
        posts.titre,
        posts.statut,
        posts.date_publication,
        categories.nom AS categorie
    FROM posts
    LEFT JOIN categories ON posts.categorie_id = categories.id
    ORDER BY posts.date_publication DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Articles</title>
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

        <div class="d-flex align-items-center">

  <!-- Nom utilisateur à droite -->
      <p class="ms-auto mb-0 fw-semibold">
        <i class="bi bi-person-fill me-1"></i>
        <?php echo htmlspecialchars($_SESSION['admin_nom']); ?>
      </p>
    </div>  

        <nav class="breadcrumbs">
          <ol>
            <li><a href="men.php">Menu</a></li>
            <li class="current">Articles</li>
          </ol>
        </nav>
        <h1>Formulaire des posts</h1>
      </div>

</div><!-- End Page Title -->
<div class="container">
      <h3 class="mb-4">
          <i class="bi bi-file-earmark-plus me-2"></i>
          Ajouter un article
      </h3>

      <?php if (isset($_GET['success'])): ?>
          <div class="alert alert-success text-center mb-4">
              Article enregistré avec succès
          </div>
      <?php endif; ?>

      <?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success text-center mb-4">
        Article supprimé avec succès
    </div>
<?php endif; ?>

    <form method="post" enctype="multipart/form-data">
<div class="row gy-4">

    <!-- Titre -->
    <div class="col-md-12">
        <label class="form-label">Titre</label>
        <input type="text" name="titre" class="form-control"
               value="<?= $editPost ? htmlspecialchars($editPost['titre']) : '' ?>"
               required>
    </div>

    <!-- Catégorie -->
    <div class="col-md-6">
        <label class="form-label">Catégorie</label>
        <select name="categorie_id" class="form-select" required>
            <option value="">-- Choisir --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"
                    <?= ($editPost && $editPost['categorie_id'] == $cat['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Statut -->
    <div class="col-md-6">
        <label class="form-label">Statut</label>
        <select name="statut" class="form-select" required>
            <option value="brouillon" <?= ($editPost && $editPost['statut']=='brouillon')?'selected':'' ?>>
                Brouillon
            </option>
            <option value="publie" <?= ($editPost && $editPost['statut']=='publie')?'selected':'' ?>>
                Publié
            </option>
        </select>
    </div>

    <!-- Image (UNIQUEMENT EN AJOUT) -->
    <?php if (!$editPost): ?>
        <div class="col-md-12">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>
    <?php endif; ?>

    <!-- Contenu -->
    <div class="col-md-12">
        <label class="form-label">Contenu</label>
        <textarea name="contenu" rows="6" class="form-control" required><?= 
            $editPost ? htmlspecialchars($editPost['contenu']) : '' 
        ?></textarea>
    </div>

    <!-- Champs cachés en mode modification -->
    <?php if ($editPost): ?>
        <input type="hidden" name="id" value="<?= $editPost['id'] ?>">
        <input type="hidden" name="old_image" value="<?= htmlspecialchars($editPost['image']) ?>">
    <?php endif; ?>

    <!-- Boutons -->
    <div class="col-md-12 d-flex justify-content-center gap-3">
        <?php if ($editPost): ?>
            <button type="submit" name="update_post" class="btn btn-warning">
                <i class="bi bi-save me-2"></i> Mettre à jour
            </button>
            <a href="articles.php" class="btn btn-secondary">
                Annuler
            </a>
        <?php else: ?>
            <button type="submit" name="add_post" class="btn btn-primary">
                <i class="bi bi-send me-2"></i> Publier
            </button>
            <button type="reset" class="btn btn-success">
                Effacer
            </button>
        <?php endif; ?>
    </div>

</div>
</form>



<hr class="my-5">

<h4 class="mb-3">
    <i class="bi bi-list-ul me-2"></i> Liste des articles
</h4>

<div class="table-responsive">
<table class="table table-striped table-hover align-middle">
<thead class="table-dark">
<tr>
    <th>#</th>
    <th>Titre</th>
    <th>Catégorie</th>
    <th>Statut</th>
    <th>Date</th>
    <th class="text-center">Actions</th>
</tr>
</thead>
<tbody>

<?php foreach ($articles as $art): ?>
<tr>
    <td><?= $art['id'] ?></td>
    <td><?= htmlspecialchars($art['titre']) ?></td>
    <td><?= htmlspecialchars($art['categorie'] ?? '—') ?></td>
    <td>
        <span class="badge bg-<?= $art['statut']=='publie'?'success':'secondary' ?>">
            <?= ucfirst($art['statut']) ?>
        </span>
    </td>
    <td><?= date('d/m/Y', strtotime($art['date_publication'])) ?></td>
    <td class="text-center">

        <a href="articles.php?edit=<?= $art['id'] ?>" class="btn btn-warning btn-sm me-2">
            <i class="bi bi-pencil-square"></i>
        </a>

        <form method="post" style="display:inline-block"
              onsubmit="return confirm('Supprimer cet article ?');">
            <input type="hidden" name="post_id" value="<?= $art['id'] ?>">
            <button type="submit" name="delete_post" class="btn btn-danger btn-sm">
                <i class="bi bi-trash"></i>
            </button>
        </form>

    </td>
</tr>
<?php endforeach; ?>

</tbody>
</table>
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
</body>

</html>
