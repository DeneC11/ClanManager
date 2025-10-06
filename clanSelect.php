<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'conexion.php';
// usuario logueado
requireLogin();
// print_r($_SESSION);
// exit;
$sql = 'SELECT c.id 
  FROM clans c
  WHERE c.idLeader = ?
  UNION
  SELECT m.idClan 
  FROM clanmembers m
  WHERE m.idUser = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['usuario_id'],$_SESSION['usuario_id']]);
$coincidencia=$stmt->fetch();
// print_r($coincidencia);
// exit;
if ($coincidencia) {
  $idClan=$coincidencia['id'];
  header("Location:dashboard.php");
  // echo'a';
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Seleccionar Clan - Clan Manager</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

  <!-- Navbar mínima -->
  <nav class="navbar navbar-dark bg-dark border-bottom border-secondary">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="#">ClanManager</a>
      <a href="logout.php" class="btn btn-outline-danger"><i class="bi bi-box-arrow-right"></i> Salir</a>
    </div>
  </nav>

  <!-- Contenido principal -->
  <div class="container py-5">
    <h1 class="text-center mb-4">Bienvenido, elige tu camino</h1>
    <p class="text-center text-secondary mb-5">Aún no perteneces a ningún clan. Puedes crear uno nuevo o unirte a uno existente.</p>

    <div class="row g-4">
      <!-- Crear Clan -->
      <div class="col-md-6">
        <div class="card bg-dark border-secondary h-100 text-center p-4 text-light">
          <i class="bi bi-shield-plus display-4 text-primary"></i>
          <h3 class="mt-3">Crear un Clan</h3>
          <p>Conviértete en líder y organiza tu propia comunidad.</p>
          <a href="createClan.php" class="btn btn-primary">Crear Clan</a>
        </div>
      </div>

      <!-- Unirse a Clan -->
      <div class="col-md-6">
        <div class="card bg-dark border-secondary h-100 text-center p-4 text-light">
          <i class="bi bi-search display-4 text-success"></i>
          <h3 class="mt-3">Unirse a un Clan</h3>
          <p>Explora los clanes existentes y solicita unirte.</p>
          <a href="joinClan.php" class="btn btn-success">Buscar Clanes</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include 'footer.php'; ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
