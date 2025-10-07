<?php
require 'conexion.php';
requireLogin();

$idClan = $_SESSION['idClan'];
$rol = $_SESSION['rolClan'];

// Obtener datos del clan
$stmt = $pdo->prepare("SELECT name, description, logo FROM clans WHERE id = ?");
$stmt->execute([$idClan]);
$clan = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Configuración del Clan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-dark text-light d-flex flex-column min-vh-100">

  <?php include 'navbar.php'; ?>

  <div class="container my-5">
    <div class="text-center mb-5">
      <h1 class="fw-bold text-primary">
        <i class="bi bi-gear-fill me-2"></i> Configuración del Clan
      </h1>
      <p class="text-secondary fs-5">Edita la información básica de tu clan o gestiona tu pertenencia.</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8">
        <div class="card bg-dark border-secondary text-light p-4 shadow-sm">
          <?php if ($rol === 'lider'): ?>
            <!-- Formulario editable -->
            <form method="post" action="updateClan.php" enctype="multipart/form-data">
              <div class="mb-3">
                <label class="form-label">Nombre del Clan</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($clan['name']) ?>" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($clan['description']) ?></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Logo</label><br>
                <?php if (!empty($clan['logo'])): ?>
                  <img src="uploads/<?= htmlspecialchars($clan['logo']) ?>" alt="Logo" class="img-thumbnail mb-2" style="max-height:100px;">
                <?php else: ?>
                  <i class="bi bi-shield-fill display-4 text-primary"></i>
                <?php endif; ?>
                <input type="file" name="logo" class="form-control mt-2">
              </div>

              <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-success">
                  <i class="bi bi-check-circle me-1"></i> Guardar cambios
                </button>
                <form method="post" action="deleteClan.php" onsubmit="return confirm('¿Seguro que quieres eliminar el clan? Esta acción no se puede deshacer.')">
                  <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash me-1"></i> Eliminar Clan
                  </button>
                </form>
              </div>
            </form>

          <?php else: ?>
            <!-- Vista solo lectura -->
            <div class="mb-3 text-center">
              <h3 class="text-primary text-capitalize"><?= htmlspecialchars($clan['name']) ?></h3>
              <p class="text-secondary"><?= nl2br(htmlspecialchars($clan['description'])) ?></p>
              <?php if (!empty($clan['logo'])): ?>
                <img src="uploads/<?= htmlspecialchars($clan['logo']) ?>" alt="Logo del clan" class="img-thumbnail" style="max-height:100px;">
              <?php else: ?>
                <i class="bi bi-shield-fill display-4 text-primary"></i>
              <?php endif; ?>
            </div>

            <form method="post" action="leaveClan.php" onsubmit="return confirm('¿Seguro que quieres salir del clan?')" class="text-center mt-4">
              <button type="submit" class="btn btn-danger">
                <i class="bi bi-box-arrow-left me-1"></i> Salir del Clan
              </button>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>