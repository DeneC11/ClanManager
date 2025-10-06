<?php
require 'conexion.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!validateCSRFToken($_POST['csrfToken'] ?? '')) {
    $errors[] = 'Error de seguridad: token CSRF invalido';
    // header('Location:login.php');
    exit;
  }
  $username = trim(htmlspecialchars($_POST['username'] ?? ''));
  $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
  $password = trim(htmlspecialchars($_POST['password'] ?? ''));
  $confirmPassword = trim(htmlspecialchars($_POST['confirmPassword'] ?? ''));
  if (!$username) $errors[] = 'Usuario requerido';
  if (!$email) $errors[] = 'email requerido';
  if (!$password) $errors[] = 'Contraseña requerida';
  if ($confirmPassword != $password) $errors[] = 'Las contraseñas no coinciden';
  // echo "$username, $email, $password, $confirmPassword";
  // print_r($_SESSION);
  // exit;
  if (empty($errors)) {
    // echo 'a';
    // exit;
    try {
      // Verifica si el usuario o email ya existen
      $sql = 'SELECT id FROM users WHERE username = ? OR email = ?';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$username, $email]);

      if ($stmt->fetch()) {
        $errors[] = 'El nombre de usuario o email ya existen';
      } else {
        // Hashea la contraseña
        $passwordHash = hashPassword($password);

        // Inserta en la base de datos
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$username, $email, $passwordHash]);

        // Redirige o muestra éxito
        $_SESSION['success'] = 'Usuario registrado con exito';
        header('Location: login.php');
        exit;
      }
    } catch (Exception $e) {
      echo 'a';
      error_log('Error del PDO en register' . $e->getMessage());
      $errors[] = 'Error interno del servidor. Inténtalo más tarde.';
      // header('Location:registro.php');
      // exit;
    }
  }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro - Clan Manager</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">

  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark border-bottom border-secondary">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="index.php">ClanManager</a>
    </div>
  </nav>

  <!-- Register Form -->
  <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card bg-dark border-secondary p-4 text-light" style="max-width: 450px; width: 100%;">
      <h2 class="text-center mb-4">Crear Cuenta</h2>
      <form class="needs-validation" method="POST" novalidate>
        <!-- token csrf -->
        <input type="hidden" name="csrfToken" value="<?= htmlspecialchars($csrfToken) ?>">
        <div class="mb-3">
          <label for="username" class="form-label"><i class="bi bi-person-circle"></i> Nombre de usuario</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Tu nombre en el clan" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label"><i class="bi bi-envelope"></i> Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="tuemail@ejemplo.com" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label"><i class="bi bi-lock"></i> Contraseña</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
        </div>
        <div class="mb-3">
          <label for="confirmPassword" class="form-label"><i class="bi bi-lock-fill"></i> Confirmar Contraseña</label>
          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="********" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Registrarse</button>
      </form>
      <p class="text-center mt-3">¿Ya tienes cuenta? <a href="login.php" class="text-decoration-none text-info">Inicia sesión</a></p>
    </div>
  </div>
  <!-- zona errores -->
  <?php if (!empty($errors)): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <ul class="mb-0">
        <?php foreach ($errors as $error): ?>
          <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
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
    //^ ocultar alertas pasado 5 segundos
    document.addEventListener('DOMContentLoaded', () => {
      setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
          alert.classList.remove('show');
          setTimeout(() => {
            alert.remove()
          }, 3000)
        })
      }, 5000);
    });
  </script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>