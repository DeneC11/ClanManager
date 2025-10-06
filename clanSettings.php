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

<body class="bg-dark text-light">

  <?php include 'navbar.php'; ?>

  <div class="container my-5">
    <h1 class="mb-4 text-primary"><i class="bi bi-gear-fill"></i> Configuración del Clan</h1>

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
            <img src="uploads/<?= htmlspecialchars($clan['logo']) ?>"
              alt="Logo"
              class="img-thumbnail mb-2"
              style="max-height:100px;">
          <?php else: ?>
            <i class="bi bi-shield-fill display-4 text-primary"></i>
          <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-success">Guardar cambios</button>
      </form>

      <!-- Botón eliminar clan -->
      <form method="post" action="deleteClan.php" onsubmit="return confirm('¿Seguro que quieres eliminar el clan? Esta acción no se puede deshacer.')" class="mt-3">
        <button type="submit" class="btn btn-danger">Eliminar Clan</button>
      </form>

    <?php else: ?>
      <!-- Vista solo lectura -->
      <div class="mb-3">
        <h3><?= htmlspecialchars($clan['name']) ?></h3>
        <p><?= nl2br(htmlspecialchars($clan['description'])) ?></p>
        <?php if (!empty($clan['logo'])): ?>
          <img src="uploads/<?= htmlspecialchars($clan['logo']) ?>"
            alt="Logo del clan"
            class="img-thumbnail"
            style="max-height:100px;">
        <?php else: ?>
          <i class="bi bi-shield-fill display-4 text-primary"></i>
        <?php endif; ?>
      </div>



      <!-- Botón salir del clan -->
      <form method="post" action="leaveClan.php" onsubmit="return confirm('¿Seguro que quieres salir del clan?')" class="mt-3">
        <button type="submit" class="btn btn-danger">Salir del Clan</button>
      </form>
    <?php endif; ?>
  </div>

  <?php include 'footer.php'; ?>
</body>

</html>