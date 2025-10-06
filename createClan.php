<?php
require 'conexion.php';
// print_r($_SESSION);
// exit;
// usuario logueado
requireLogin();
$id = $_SESSION['usuario_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!validateCSRFToken($_POST['csrfToken'] ?? '')) {
    $errors[] = 'Error de seguridad: token CSRF invalido';
    // header('Location:login.php');
    exit;
  }
  $clanName = trim(htmlspecialchars($_POST['clanName'] ?? ''));
  $clanDescription = trim(htmlspecialchars($_POST['clanDescription'] ?? ''));
  $clanLogo = trim(htmlspecialchars($_POST['clanLogo'] ?? ''));
  if (!$clanName) {
    $errors[] = "Nombre del clan obligatorio";
    exit;
  }
  // comprobar que el nombre no este usado
  try {
    $sql = 'SELECT id FROM clans WHERE name= ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$clanName]);
  } catch (PDOException $e) {
    error_log('Error del PDO en login' . $e->getMessage());
  }
  if ($stmt->fetch()) {
    $errors[] = 'Clan ya existente';
    // header('Location:login.php');
    // exit;
  } else {
    if (empty($errors)) {

      // insertar en DB
      // echo"$id";
      // exit;
      // clrear clan
      $sql = 'INSERT INTO clans (name, description, logo,idLeader) VALUES(?,?,?,?)';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$clanName, $clanDescription, $clanLogo??null, $id]);
      // echo'a';
      // exit;
      // redirigir a clan
      $sql = 'SELECT id FROM clans WHERE name= ?';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$clanName]);
      $coincidencia = $stmt->fetch();
      $idClan = $coincidencia['id'];
      // designar usuario como lider
      $sql = 'INSERT INTO clanmembers (idClan, idUser, role) VALUES(?,?,?)';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$idClan, $id, 'lider']);
      // echo'a';
      // print_r($coincidencia);
      // exit;
      if ($coincidencia) {
        $idClan = $coincidencia['id'];
        header("Location:dashboard.php");
        // echo'a';
        exit;
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Crear Clan - Clan Manager</title>
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

  <!-- Formulario -->
  <div class="container py-5">
    <h1 class="text-center mb-4"><i class="bi bi-shield-plus"></i> Crear un Clan</h1>
    <div class="card bg-dark border-secondary p-4 mx-auto text-light" style="max-width: 500px;">
      <form class="needs-validation" method="POST" novalidate>
        <input type="hidden" name="csrfToken" value="<?= htmlspecialchars($csrfToken) ?>">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="mb-3">
          <label for="clanName" class="form-label">Nombre del Clan</label>
          <input type="text" class="form-control" id="clanName" name="clanName" placeholder="Ej: Guerreros del Alba" required>
        </div>
        <div class="mb-3">
          <label for="clanDescription" class="form-label">Descripción</label>
          <textarea class="form-control" id="clanDescription" name="clanDescription" rows="3" placeholder="Describe tu clan..." required></textarea>
        </div>
        <div class="mb-3">
          <label for="clanLogo" class="form-label">Logo (URL o archivo)</label>
          <input type="text" class="form-control" id="clanLogo" name="clanLogo" placeholder="https://...">
        </div>
        <button type="submit" class="btn btn-primary w-100">Crear Clan</button>
        <a href="dashboard.php" class="text-decoration-none text-ccenter mt-3 text-info">preview</a>

      </form>
    </div>
  </div>
  <!-- Footer -->
  <?php include 'footer.php'; ?>

  <!-- scripts -->
  <script>
    //^ validacion javascript de bootstrap
    (() => {
      'use strict'
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')
      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>