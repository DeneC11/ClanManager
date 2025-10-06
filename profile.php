<?php
require 'conexion.php';
// usuario logueado
requireLogin();
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
<body class="bg-dark text-light">

  <?php include 'navbar.php'; ?>

  <header class="py-5 text-center">
    <h1><i class="bi bi-person-circle"></i> Mi Perfil</h1>
    <p class="text-secondary">Consulta y edita tu información personal.</p>
  </header>

  <div class="container py-4">
    <!-- Aquí irá la info del perfil -->
    <div class="alert alert-secondary">Información de perfil próximamente...</div>
  </div>
  <!-- Footer -->
  <?php include 'footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
