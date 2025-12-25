<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: /login.php");
    exit;
}

require_once "forms/condb.php";

$editCategory = null;

if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];

    $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $editCategory = $stmt->fetch(PDO::FETCH_ASSOC);
}


// Récupération des catégories
$stmt = $pdo->query("SELECT id, nom, slug FROM categories ORDER BY id DESC");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Suppression d'une catégorie
if (isset($_POST['delete_category'])) {

    $id = (int) $_POST['category_id'];

    // Vérifier si la catégorie est utilisée
    $checkPosts = $pdo->prepare("
        SELECT COUNT(*) FROM posts WHERE categorie_id = :id
    ");
    $checkPosts->execute(['id' => $id]);
    $count = $checkPosts->fetchColumn();

    if ($count > 0) {
        header("Location: add_category.php?error=used");
        exit;
    }

    // Supprimer si non utilisée
    $delete = $pdo->prepare("DELETE FROM categories WHERE id = :id");
    $delete->execute(['id' => $id]);

    header("Location: add_category.php?deleted=1");
    exit;
}

if (isset($_POST['update_category'])) {

    $id  = (int) $_POST['id'];
    $nom = trim($_POST['nom']);

    // Générer le slug
    $slug = strtolower($nom);
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');

    $stmt = $pdo->prepare("
        UPDATE categories
        SET nom = :nom, slug = :slug
        WHERE id = :id
    ");

    $stmt->execute([
        'nom'  => $nom,
        'slug' => $slug,
        'id'   => $id
    ]);

    header("Location: add_category.php?updated=1");
    exit;
}


if (isset($_POST['add_category'])) {

    $nom = trim($_POST['nom']);

    // Génération du slug
    $slug = strtolower($nom);
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');

    // Vérifier si la catégorie existe déjà
    $check = $pdo->prepare("SELECT id FROM categories WHERE slug = :slug");
    $check->execute(['slug' => $slug]);

    if ($check->rowCount() > 0) {
        header("Location: add_category.php?error=exists");
        exit;
    }

    // Insertion
    $stmt = $pdo->prepare("
        INSERT INTO categories (nom, slug)
        VALUES (:nom, :slug)
    ");
    $stmt->execute([
        'nom'  => $nom,
        'slug' => $slug
    ]);

    header("Location: add_category.php?success=1");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Gestion de catégories</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon11.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
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
            <li><a href="men.php">Menu</a></li>
            <li class="current">Catégories</li>
          </ol>
        </nav>
        <h1>Gestion de catégories</h1>
      </div>
    </div><!-- End Page Title -->

    
 <main class="main">

    <div class="container">
            <br><br>


    <h3 class="mb-4">
        <i class="bi bi-folder-plus me-2"></i>
        Ajouter une catégorie
    </h3>
                         <!-- Message d'ajout reusi -->
                        <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success text-center mb-4">
                                <i class="bi bi-check-circle me-2"></i>
                                Catégorie ajoutée avec succès
                            </div>
                        <?php endif; ?>
                <!-- Message suppression de la catégorie -->
                        <?php if (isset($_GET['error']) && $_GET['error'] === 'exists'): ?>
                            <div class="alert alert-danger text-center mb-4">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Cette catégorie existe déjà
                            </div>
                        <?php endif; ?>

            <!-- Message cat supprimée avec succès -->             

                        <?php if (isset($_GET['deleted'])): ?>
                        <div class="alert alert-success text-center mb-4">
                            <i class="bi bi-check-circle me-2"></i>
                            Catégorie supprimée avec succès
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['error']) && $_GET['error'] === 'notfound'): ?>
                        <div class="alert alert-danger text-center mb-4">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Catégorie introuvable
                        </div>
                    <?php endif; ?>

 <!-- Message suppression d'avertissement quand la cat est déjà utilisé -->
                    <?php if (isset($_GET['error']) && $_GET['error'] === 'used'): ?>
                    <div class="alert alert-warning text-center mb-4">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        Impossible de supprimer cette catégorie : elle est liée à un ou plusieurs articles.
                    </div>
                <?php endif; ?>

 <!-- Message update categorie-->
                <?php if (isset($_GET['updated'])): ?>
                  <div class="alert alert-success text-center mb-4">
                      <i class="bi bi-check-circle me-2"></i>
                      Catégorie mise à jour avec succès
                  </div>
              <?php endif; ?>




       <div class="col-lg-8 order-lg-1 mx-auto">
                            <form method="post" action="">
                                <div class="row gy-4">

                                    <!-- Nom de la catégorie -->
                                    <div class="col-md-12">

                                      <?php if ($editCategory): ?>
                                          <input type="hidden" name="id" value="<?= $editCategory['id'] ?>">
                                      <?php endif; ?>

                                        <label class="form-label">Nom de la catégorie</label>
                                        <input 
                                            type="text" 
                                            name="nom"
                                            class="form-control"
                                            placeholder="Ex : Développement Web"
                                            value="<?= $editCategory ? htmlspecialchars($editCategory['nom']) : '' ?>"
                                            required
                                        >
                                    </div>

                                    <!-- Boutons -->
                                   <div class="col-md-12 d-flex justify-content-center gap-3">

                                      <?php if ($editCategory): ?>
                                          <button type="submit" name="update_category" class="btn btn-warning">
                                              <i class="bi bi-save me-2"></i>
                                              Mettre à jour
                                          </button>

                                          <a href="add_category.php" class="btn btn-secondary">
                                              <i class="bi bi-x-circle me-2"></i>
                                              Annuler
                                          </a>
                                      <?php else: ?>
                                          <button type="submit" name="add_category" class="btn btn-primary">
                                              <i class="bi bi-plus-circle me-2"></i>
                                              Ajouter
                                          </button>

                                          <button type="reset" class="btn btn-success">
                                              <i class="bi bi-x-circle me-2"></i>
                                              Effacer
                                          </button>
                                      <?php endif; ?>

                              </div>


                                </div>
                            </form>
              <hr class="my-5">

<h4 class="mb-3">
    <i class="bi bi-list-ul me-2"></i>
    Liste des catégories
</h4>

<div class="table-responsive">
    <table class="table table-dark table-striped table-hover align-middle">
        <thead class="table-secondary text-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>slug</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php if (count($categories) > 0): ?>
            <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?= htmlspecialchars($cat['id']) ?></td>
                    <td><?= htmlspecialchars($cat['nom']) ?></td>
                    <td><?= htmlspecialchars($cat['slug']) ?></td>
                    <td class="text-center">
                       <a href="add_category.php?edit=<?= $cat['id'] ?>" 
                               class="btn btn-warning btn-sm me-2">
                                <i class="bi bi-pencil-square me-1"></i>
                                Modifier
                      </a>

                          <form method="post" action="" 
                                onsubmit="return confirm('Voulez-vous vraiment supprimer cette catégorie ?');"
                                style="display:inline-block;">

                              <input type="hidden" name="category_id" value="<?= $cat['id'] ?>">

                              <button type="submit" name="delete_category" class="btn btn-danger btn-sm">
                                  <i class="bi bi-trash me-1"></i>
                                  Supprimer
                              </button>
                          </form>
                      </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center text-muted">
                    Aucune catégorie enregistrée
                </td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>
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
