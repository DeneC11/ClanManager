<?php
require 'conexion.php';
requireLogin();

if ($_SESSION['rolClan'] === 'miembro') {
  die("No tienes permisos para editar roles de juego.");
}

$idClan = $_SESSION['idClan'];

if (!empty($_POST['gameRole'])) {
  foreach ($_POST['gameRole'] as $idUser => $role) {
    $stmt = $pdo->prepare("UPDATE clanmembers SET gameRole = ? WHERE idUser = ? AND idClan = ?");
    $stmt->execute([$role, $idUser, $idClan]);
  }
}

header("Location: clanMembers.php");
exit;
?>