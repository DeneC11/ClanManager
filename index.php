<?php
require 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clan Manager</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

  <!-- Navbar simplificada -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="#">ClanManager</a>
      <div class="d-flex">
        <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
        <a href="register.php" class="btn btn-primary">Registro</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <header class="py-5 text-center bg-gradient">
    <div class="container">
      <h1 class="display-4 fw-bold">Organiza tu Clan, Domina la Batalla</h1>
      <p class="lead text-secondary">Crea clanes, gestiona partys para guerras y distribuye DKPs de forma sencilla.</p>
      <a href="clanSelect.php" class="btn btn-lg btn-primary mt-3">Empieza Ahora</a>
    </div>
  </header>

  <!-- Features -->
  <section class="py-5">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4 mb-4">
          <div class="card bg-dark border-secondary h-100">
            <div class="card-body text-light">
              <i class="bi bi-shield-shaded display-4 text-primary"></i>
              <h5 class="card-title mt-3">Gestor de Clanes</h5>
              <p class="card-text">Crea tu clan, invita miembros y organiza tu comunidad gamer.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card bg-dark border-secondary h-100">
            <div class="card-body text-light">
              <i class="bi bi-people-fill display-4 text-success"></i>
              <h5 class="card-title mt-3">Partys de Guerra</h5>
              <p class="card-text">Forma grupos para raids y guerras con roles personalizados.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card bg-dark border-secondary h-100">
            <div class="card-body text-light">
              <i class="bi bi-trophy-fill display-4 text-warning"></i>
              <h5 class="card-title mt-3">Sistema DKP</h5>
              <p class="card-text">Distribuye puntos de forma justa y lleva el control de tu clan.</p>
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
