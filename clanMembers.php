<?php
require 'conexion.php';
// usuario logueado
requireLogin();
$idClan = $_SESSION['idClan'];
$rol = $_SESSION['rolClan'];
$stmt = $pdo->prepare("
  SELECT u.id, u.username, m.role, m.gameRole
  FROM clanmembers m
  JOIN users u ON m.idUser = u.id
  WHERE m.idClan = ?
  ORDER BY 
    CASE m.role 
      WHEN 'lider' THEN 1 
      WHEN 'oficial' THEN 2 
      ELSE 3 
    END,
    u.username ASC
");
$stmt->execute([$idClan]);
$miembros = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Miembros - Clan Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">

  <?php include 'navbar.php'; ?> <!-- opcional si luego extraes la navbar -->

  <header class="py-5 text-center">
    <h1><i class="bi bi-people-fill"></i> Miembros del Clan</h1>
    <p class="text-secondary">Gestiona los miembros y asigna roles personalizados.</p>
  </header>

  <div class="container my-5">
    <h2 class="mb-4 text-primary"><i class="bi bi-people-fill"></i> Miembros del Clan</h2>

    <form method="post" action="updateMembers.php"
      onsubmit="return confirm('¿Seguro que quieres guardar los cambios de roles?')">

      <table class="table table-dark table-striped align-middle">
        <thead>
          <tr>
            <th>Usuario</th>
            <th>Rol en el Clan</th>
            <th>Rol en el Juego</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($miembros as $m): ?>
            <tr>
              <td><?= htmlspecialchars($m['username']) ?></td>

              <!-- Rol en el clan -->
              <td>
                <?php if ($_SESSION['rolClan'] === 'lider'): ?>
                  <select name="clanRole[<?= $m['id'] ?>]" class="form-select form-select-sm w-auto">
                    <option value="" <?= empty($m['role']) ? 'selected' : '' ?>>---</option>
                    <option value="lider" <?= $m['role'] === 'lider' ? 'selected' : '' ?>>Líder</option>
                    <option value="oficial" <?= $m['role'] === 'oficial' ? 'selected' : '' ?>>Oficial</option>
                    <option value="miembro" <?= $m['role'] === 'miembro' ? 'selected' : '' ?>>Miembro</option>
                  </select>
                <?php else: ?>
                  <?php if (empty($m['role'])): ?>
                    ---
                  <?php elseif ($m['role'] === 'lider'): ?>
                    <span class="badge bg-danger">Líder</span>
                  <?php elseif ($m['role'] === 'oficial'): ?>
                    <span class="badge bg-warning text-dark">Oficial</span>
                  <?php else: ?>
                    <span class="badge bg-secondary">Miembro</span>
                  <?php endif; ?>
                <?php endif; ?>
              </td>

              <!-- Rol en el juego -->
              <td>
                <?php if ($_SESSION['rolClan'] === 'lider' || $_SESSION['rolClan'] === 'oficial'): ?>
                  <select name="gameRole[<?= $m['id'] ?>]" class="form-select form-select-sm w-auto">
                    <option value="" <?= empty($m['gameRole']) ? 'selected' : '' ?>>---</option>
                    <option value="tank" <?= $m['gameRole'] === 'tank' ? 'selected' : '' ?>>Tank</option>
                    <option value="heal" <?= $m['gameRole'] === 'heal' ? 'selected' : '' ?>>Heal</option>
                    <option value="dps" <?= $m['gameRole'] === 'dps' ? 'selected' : '' ?>>DPS</option>
                  </select>
                <?php else: ?>
                  <?php if (empty($m['gameRole'])): ?>
                    ---
                  <?php elseif ($m['gameRole'] === 'tank'): ?>
                    <span class="badge bg-primary">Tank</span>
                  <?php elseif ($m['gameRole'] === 'heal'): ?>
                    <span class="badge bg-success">Heal</span>
                  <?php else: ?>
                    <span class="badge bg-danger">DPS</span>
                  <?php endif; ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>

      </table>

      <?php if ($_SESSION['rolClan'] === 'lider' || $_SESSION['rolClan'] === 'oficial'): ?>
        <button type="submit" class="btn btn-success mt-3">
          Guardar cambios
        </button>
      <?php endif; ?>
    </form>
  </div>


  <!-- Footer -->
  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>