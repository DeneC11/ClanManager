<?php
require 'conexion.php';
requireLogin();

if ($_SESSION['rolClan'] !== 'lider') {
  die("No tienes permisos.");
}

$idClan = $_SESSION['idClan'];
$name = $_POST['name'];
$description = $_POST['description'];

// Subida de logo opcional
$logoName = null;
if (!empty($_FILES['logo']['name'])) {
  $logoName = time() . "_" . basename($_FILES['logo']['name']);
  move_uploaded_file($_FILES['logo']['tmp_name'], "uploads/" . $logoName);
}

if ($logoName) {
  $stmt = $pdo->prepare("UPDATE clans SET name=?, description=?, logo=? WHERE id=?");
  $stmt->execute([$name, $description, $logoName, $idClan]);
} else {
  $stmt = $pdo->prepare("UPDATE clans SET name=?, description=? WHERE id=?");
  $stmt->execute([$name, $description, $idClan]);
}

header("Location: clanSettings.php");
exit;
?>