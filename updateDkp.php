<?php
require 'conexion.php';
requireLogin();

$idClan = $_SESSION['idClan'];
$rolActual = $_SESSION['rolClan'];

if ($rolActual === 'miembro') {
  die("No tienes permisos para editar DKP.");
}

if (!empty($_POST['dkpChange'])) {
  foreach ($_POST['dkpChange'] as $idUser => $change) {
    if ($change === '' || $change == 0) continue;

    $reason = $_POST['reason'][$idUser] ?? 'Ajuste manual';

    // Insertar un registro en la tabla dkps
    $stmt = $pdo->prepare("INSERT INTO dkps (idClan, idUser, points, reason) VALUES (?, ?, ?, ?)");
    $stmt->execute([$idClan, $idUser, $change, $reason]);
  }
}

header("Location: clanDkps.php");
exit;
?>