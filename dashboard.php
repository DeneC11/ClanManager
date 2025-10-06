<?php
require 'conexion.php';
// usuario logueado
requireLogin();
// print_r($_SESSION);
// exit;
// Array ( [csrfToken] => 804880e6f2f07b94d4d0a03c5ec8a3e0aff427a89970db18c160ac7730dc2bc1 [usuario_id] => 2 [username] => lider1 [email] => lider1@mail.com )
$idUsuario=$_SESSION['usuario_id'];
// obtener clan del usuario
$sql="SELECT c.name, c.description, c.id, m.role FROM clanmembers m JOIN clans c ON m.idClan=c.id WHERE m.idUser=?";
$stmt=$pdo->prepare($sql);
$stmt->execute([$idUsuario]);
$resultados=$stmt->fetch();
$_SESSION['idClan']=$resultados['id'];
$_SESSION['rolClan'] = $resultados['role'];
if(!$resultados){  
  // Redirigir a clanSelect.php si no pertenece a ningún clan
  header("Location: clanSelect.php");
  exit;
}
// Array ( [0] => Array ( [id] => 2 [name] => clan2 [description] => descripcion del clan2 [logo] => [idLeader] => 1 ) )
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Clan Manager</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

  <!-- Navbar completa -->
    <?php include 'navbar.php'; ?> <!-- opcional si luego extraes la navbar -->


  <!-- Header de bienvenida -->
  <header class="py-5 text-center">
    <div class="container">
      <h1 class="fw-bold">Bienvenido <?= $_SESSION['username'] ?> a <?= $resultados['name'] ?></h1>
      <p class="text-secondary"><?= $resultados['description'] ?></p>
      <p class="text-secondary">Gestiona tu clan, organiza partys y controla los DKPs desde un solo lugar.</p>
    </div>
  </header>

  <!-- Accesos rápidos -->
  <section class="py-5">
    <div class="container ">
      <div class="row g-4 text-center ">
        <div class="col-md-4">
          <div class="card bg-dark border-secondary h-100">
            <div class="card-body text-light">
              <i class="bi bi-people-fill display-4 text-primary"></i>
              <h5 class="card-title mt-3">Miembros</h5>
              <p class="card-text">Gestiona los miembros de tu clan y asigna roles.</p>
              <a href="clanMembers.php" class="btn btn-outline-primary">Ir a Miembros</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card bg-dark border-secondary h-100">
            <div class="card-body text-light">
              <i class="bi bi-controller display-4 text-success"></i>
              <h5 class="card-title mt-3">Partys</h5>
              <p class="card-text">Crea y organiza grupos para guerras y raids.</p>
              <a href="clanPartys.php" class="btn btn-outline-success">Ir a Partys</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card bg-dark border-secondary h-100">
            <div class="card-body text-light">
              <i class="bi bi-trophy-fill display-4 text-warning"></i>
              <h5 class="card-title mt-3">DKPs</h5>
              <p class="card-text">Distribuye puntos y consulta el ranking de tu clan.</p>
              <a href="clanDkps.php" class="btn btn-outline-warning">Ir a DKPs</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Segunda fila -->
      <div class="row g-4 text-center mt-4">
        <div class="col-md-6">
          <div class="card bg-dark border-secondary h-100">
            <div class="card-body text-light">
              <i class="bi bi-gear-fill display-4 text-info"></i>
              <h5 class="card-title mt-3">Configuración</h5>
              <p class="card-text">Edita la información de tu clan y gestiona permisos.</p>
              <a href="clanSettings.php" class="btn btn-outline-info">Ir a Configuración</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card bg-dark border-secondary h-100">
            <div class="card-body text-light">
              <i class="bi bi-person-circle display-4 text-light"></i>
              <h5 class="card-title mt-3">Perfil</h5>
              <p class="card-text">Consulta y edita tu información personal.</p>
              <a href="profile.php" class="btn btn-outline-light">Ir a Perfil</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Footer -->
  <?php include 'footer.php'; ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
