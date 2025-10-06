<?php
require 'conexion.php';
$errors = [];
// $errors[] = 'esto no es un error';
// Mostrar mensaje de registro exitoso
if (isset($_SESSION['success'])) {
  $errors[] = $_SESSION['success'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!validateCSRFToken($_POST['csrfToken'] ?? '')) {
    $errors[] = 'Error de seguridad: token CSRF invalido';
    // header('Location:login.php');
    exit;
  }
  // sanear datos
  $indentificador = trim(htmlspecialchars($_POST['indentificador'] ?? '', ENT_QUOTES, 'UTF-8'));
  $password = trim(htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8'));

  if (!$indentificador) $errors[] = 'Usuario o email requeridos';
  if (!$password) $errors[] = 'Contraseña requerida';

  if (!empty($indentificador) && !empty($password)) {
    try {
      $sql = "SELECT id,username,email,password FROM users WHERE email=? OR username=?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$indentificador, $indentificador]);
      $usuario = $stmt->fetch();
      // echo'<pre>';
      // print_r($usuario);
      // echo'</pre>';
      // exit;
      // Array(
      //   [id] => 1
      //   [username] => pplotas
      //   [email] => pplotas@mail.com
      //   [password] => 123456aA
      // )
      if ($usuario) {     
        // $a=password_verify($password, $usuario['password']);
        // echo"a: $a";
        // exit;   
        if (password_verify($password, $usuario['password'])) {
          // echo'a';
          // print_r($_SESSION);
          // exit;
          session_regenerate_id(true);
          $_SESSION['usuario_id'] = $usuario['id'];
          $_SESSION['username'] = $usuario['username'];
          $_SESSION['email'] = $usuario['email'];
          // echo '<br>'. $_SESSION['usuario_id'];
          // echo '<br>'. $_SESSION['username'];
          // echo '<br>'. $_SESSION['email'];
          // exit;
          unset($_SESSION['registro_exitoso']); // Elimina el mensaje para que no se repita
          header('Location:clanSelect.php');
          exit;
        }
      }else{
        $errors[] = 'Usuario no encontrado';
      }
      $errors[] = 'Contraseña incorrecta';
      // header('Location:login.php');
      // exit;
    } catch (PDOException $e) {
      error_log('Error del PDO en login' . $e->getMessage());
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Clan Manager</title>
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

  <!-- Login Form -->
  <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card bg-dark border-secondary p-4 text-light" style="max-width: 400px; width: 100%;">
      <h2 class="text-center mb-4">Iniciar Sesión</h2>
      <form class="needs-validation" method="POST" novalidate>
        <!-- token csrf -->
        <input type="hidden" name="csrfToken" value="<?= htmlspecialchars($csrfToken) ?>">
        <div class="mb-3">
          <label for="indentificador" class="form-label"><i class="bi bi-person"></i> Usuario o email</label>
          <input type="text" class="form-control" id="indentificador" name="indentificador" placeholder="tuuser o tuemail@ejemplo.com" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label"><i class="bi bi-lock"></i> Contraseña</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Entrar</button>
      </form>
      <p class="text-center mt-3">¿No tienes cuenta? <a href="register.php" class="text-decoration-none text-info">Regístrate</a></p>
      <a href="clanSelect.php" class="text-decoration-none text-info text-center">preview</a>
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