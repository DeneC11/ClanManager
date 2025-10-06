<?php
require 'conexion.php';
// usuario logueado
requireLogin();
// print_r($_SESSION);
// exit;
$id = $_SESSION['usuario_id'];
// clanes
$sql = "SELECT c.id,c.name, c.description, c.logo, u.username FROM clans c LEFT JOIN users u ON c.idLeader=u.id";
$stmt = $pdo->query($sql);
$clanes = $stmt->fetchAll();
// echo '<pre>';
// print_r($clanes);
// echo '</pre>';
// exit;
// Array
// (
//     [0] => Array
//         (
//             [name] => clan2
//             [description] => descripcion del clan2
//             [logo] => 
//             [username] => pplotas
//         )

//     [1] => Array
//         (
//             [name] => clanNuevo
//             [description] => clan del lider 1
//             [logo] => 
//             [username] => lider1
//         )

// )
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!validateCSRFToken($_POST['csrfToken'] ?? '')) {
    $errors[] = 'Error de seguridad: token CSRF invalido';
    // header('Location:login.php');
    exit;
  }
  // print_r($_POST);
  // exit;
  // Array ( [idClan] => 6 [csrfToken] => 0dd6f0510154d12e0e80403496d24e44cf7cad7030cb428268db6f3544a7fd9d )
  $idUsuario = $id;
  $idClan = htmlspecialchars($_POST['idClan']);
  // comprobar si el usuario ya está en un clan
  $sql = "SELECT idClan FROM clanmembers WHERE idUser = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$idUsuario]);
  $yaEnClan = $stmt->fetch();

  if ($yaEnClan) {
    // ya pertenece a un clan
      echo "<script>
        alert('Ya perteneces a un clan');
        window.location.href = 'dashboard.php';
      </script>";
      // header("Location:joinClan.php");
      exit;
  }
  try {
    // echo'a';
    // exit;
    // unir usuario al clan
    $sql = 'INSERT INTO clanmembers (idClan, idUser) VALUES(?,?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idClan, $idUsuario]);
    header("Location:dashboard.php");
    exit;
  } catch (PDOException $e) {
    error_log('Error del PDO en login' . $e->getMessage());
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Unirse a un Clan - Clan Manager</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">

  <!-- Navbar mínima -->
  <nav class="navbar navbar-dark bg-dark border-bottom border-secondary">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="clanSelect.php">ClanManager</a>
      <a href="logout.php" class="btn btn-outline-danger"><i class="bi bi-box-arrow-right"></i> Salir</a>
    </div>
  </nav>

  <!-- Listado de clanes -->
  <div class="container py-5">
    <h1 class="text-center mb-4"><i class="bi bi-search"></i> Buscar Clanes</h1>
    <p class="text-center text-secondary mb-5">Explora los clanes disponibles y solicita unirte.</p>

    <div class="row g-4">
      <!-- Ejemplo de clan (esto luego vendrá de la BD con un loop PHP) -->
      <?php if (count($clanes) > 0): ?>
        <!-- si hay clanes creados -->
        <?php foreach ($clanes as $clan): ?>
          <div class="col-md-4">
            <div class="card bg-dark border-secondary h-100">
              <div class="card-body text-center text-light">
                <!-- <?= $clan['logo'] ?? '<i class="bi bi-shield-fill display-4 text-primary"></i>' ?>-->
                <i class="bi bi-shield-fill display-4 text-primary"></i>
                <h5 class="card-title mt-3"><?= $clan['name'] ?></h5>
                <p class="card-text"><?= $clan['description'] ?></p>
                <p class="card-text">Lider: <?= $clan['username'] ?></p>
                <!-- boton unirse -->
                <form method="post" class="d-line" onsubmit="return confirm('Estas seguro que quieres unirte a este clan?')">
                  <!-- action="dashboard.php?id=<?= $clan['id'] ?>" -->
                  <input type="hidden" name="idClan" value="<?= $clan['id'] ?>">
                  <input type="hidden" name="csrfToken" value="<?= htmlspecialchars($csrfToken) ?>">
                  <button type="submit" class="btn btn-success" title="unirse al clan">
                    Unirse
                  </button>
                </form>
                <!-- <a href="dashboard.php?id=<?= $clan['id'] ?>" class="btn btn-success">Unirse</a> -->
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <!-- si no hay clanes creados -->
      <?php endif; ?>




      <!-- Más clanes se generarían dinámicamente -->
    </div>
  </div>
  <!-- Footer -->
  <?php include 'footer.php'; ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>