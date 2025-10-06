<?php
require 'conexion.php';
// usuario logueado
requireLogin();
$stmt = $pdo->prepare("
  SELECT u.id, u.username, m.role, m.gameRole, 
  COALESCE(SUM(d.points),0) as totalDkp
  FROM clanmembers m
  JOIN users u ON m.idUser = u.id
  LEFT JOIN dkps d ON d.idUser = u.id AND d.idClan = m.idClan
  WHERE m.idClan = ?
  GROUP BY u.id, u.username, m.role, m.gameRole
  ORDER BY totalDkp DESC, u.username ASC
");
$stmt->execute([$_SESSION['idClan']]);
$miembros = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DKPs - Clan Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">

  <?php include 'navbar.php'; ?>

  <header class="py-5 text-center">
    <h1><i class="bi bi-trophy-fill"></i> Sistema DKP</h1>
    <p class="text-secondary">Distribuye puntos y consulta el ranking de tu clan.</p>
  </header>

  <div class="container my-5">
  <h2 class="mb-4 text-primary"><i class="bi bi-trophy-fill"></i> Puntuaciones DKP</h2>

  <form method="post" action="updateDkp.php"
        onsubmit="return confirm('¿Seguro que quieres aplicar estos cambios de DKP?')">

    <table class="table table-dark table-striped align-middle">
      <thead>
        <tr>
          <th>Usuario</th>
          <th>Rol Clan</th>
          <th>Rol Juego</th>
          <th>DKP Actual</th>
          <?php if ($_SESSION['rolClan'] !== 'miembro'): ?>
            <th>Ajustar</th>
            <th>Motivo</th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($miembros as $m): ?>
          <tr>
            <td><?= htmlspecialchars($m['username']) ?></td>
            <td><?= htmlspecialchars($m['role'] ?: '---') ?></td>
            <td><?= htmlspecialchars($m['gameRole'] ?: '---') ?></td>
            <td><span class="badge bg-info text-dark"><?= $m['totalDkp'] ?></span></td>

            <?php if ($_SESSION['rolClan'] === 'lider' || $_SESSION['rolClan'] === 'oficial'): ?>
              <td>
                <input type="number" name="dkpChange[<?= $m['id'] ?>]" 
                       class="form-control form-control-sm w-50 d-inline" 
                       placeholder="+/- puntos">
              </td>
              <td>
                <input type="text" name="reason[<?= $m['id'] ?>]" 
                       class="form-control form-control-sm" 
                       placeholder="Motivo">
              </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <?php if ($_SESSION['rolClan'] === 'lider' || $_SESSION['rolClan'] === 'oficial'): ?>
      <button type="submit" class="btn btn-success mt-3">Guardar cambios</button>
    <?php endif; ?>
  </form>
</div>

  <!-- Footer -->
  <?php include 'footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>