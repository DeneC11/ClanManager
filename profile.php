<?php
require 'conexion.php';
// usuario logueado
requireLogin();
// print_r($_SESSION);
// exit;
$userId = $_SESSION['usuario_id'];

// 1. Datos del usuario
$sqlUser = "SELECT username, email, registro FROM users WHERE id = ?";
$stmtUser = $pdo->prepare($sqlUser);
$stmtUser->execute([$userId]);
$userData = $stmtUser->fetch();

// 2. Datos del clan y rol desde clanmembers
$sqlMember = "SELECT cm.role, cm.gameRole, c.name AS clanName, c.description AS clanDescription, c.logo
              FROM clanmembers cm
              JOIN clans c ON cm.idClan = c.id
              WHERE cm.idUser = ?";
$stmtMember = $pdo->prepare($sqlMember);
$stmtMember->execute([$userId]);
$clanData = $stmtMember->fetch();

// 3. Historial de DKPs
$sqlDKP = "SELECT points, reason, createdAt FROM dkps WHERE idUser = ? ORDER BY createdAt DESC";
$stmtDKP = $pdo->prepare($sqlDKP);
$stmtDKP->execute([$userId]);
$dkpHistorial = $stmtDKP->fetchAll();

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perfil - Clan Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-dark text-light d-flex flex-column min-vh-100">

  <?php include 'navbar.php'; ?>

  <main class="container py-5">
    <div class="text-center mb-5">
      <h1 class="fw-bold text-light">
        <i class="bi bi-person-circle me-2"></i> Perfil de <?= htmlspecialchars($userData['username']) ?>
      </h1>
      <p class="text-secondary fs-5">
        Miembro del clan <strong class="text-primary"><?= htmlspecialchars($clanData['clanName']) ?></strong>
      </p>
    </div>

    <div class="row justify-content-center g-4">
      <!-- Información del usuario -->
      <div class="col-md-10 col-lg-8">
        <div class="card bg-dark border-secondary text-light p-4">
          <h5 class="card-title"><i class="bi bi-info-circle me-2 text-info"></i> Información personal</h5>
          <ul class="list-unstyled">
            <li><strong>Nombre de usuario:</strong> <?= htmlspecialchars($userData['username']) ?></li>
            <li><strong>Email:</strong> <?= htmlspecialchars($userData['email']) ?></li>
            <li><strong>Fecha de registro:</strong> <?= date('d/m/Y', strtotime($userData['registro'])) ?></li>
            <li><strong>Rol en el clan:</strong> <?= ucfirst($clanData['role']) ?></li>
            <li><strong>Rol de juego:</strong>
              <form method="post" action="updateGameRole.php" class="d-inline-block ms-2">
                <select name="game_role" class="form-select form-select-sm d-inline w-auto">
                  <option value="" <?= empty($clanData['gameRole']) ? 'selected' : '' ?>>---</option>
                  <option value="tank" <?= $clanData['gameRole'] === 'tank' ? 'selected' : '' ?>>Tank</option>
                  <option value="dps" <?= $clanData['gameRole'] === 'dps' ? 'selected' : '' ?>>DPS</option>
                  <option value="heal" <?= $clanData['gameRole'] === 'heal' ? 'selected' : '' ?>>Heal</option>
                </select>
                <button type="submit" class="btn btn-outline-info btn-sm ms-2">Actualizar</button>
              </form>

            </li>
          </ul>
        </div>
      </div>

      <!-- Historial de DKPs -->
      <div class="col-md-10 col-lg-8">
        <div class="card bg-dark border-secondary text-light p-4">
          <h5 class="card-title"><i class="bi bi-trophy-fill me-2 text-warning"></i> Historial de DKPs</h5>
          <?php if (!empty($dkpHistorial)): ?>
            <table class="table table-dark table-bordered table-sm">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Cambio</th>
                  <th>Motivo</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($dkpHistorial as $registro): ?>
                  <tr>
                    <td><?= date('d/m/Y', strtotime($registro['createdAt'])) ?></td>
                    <td class="<?= $registro['points'] >= 0 ? 'text-success' : 'text-danger' ?>">
                      <?= $registro['points'] >= 0 ? '+' : '' ?><?= $registro['points'] ?>
                    </td>
                    <td><?= htmlspecialchars($registro['reason']) ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php else: ?>
            <p class="text-light">Aún no tienes movimientos registrados.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </main>


  <!-- Footer -->
  <?php include 'footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>