<?php
require 'conexion.php';
requireLogin();

if ($_SESSION['rolClan'] !== 'lider') {
  die("No tienes permisos.");
}

$idClan = $_SESSION['idClan'];

// Eliminar miembros primero
$pdo->prepare("DELETE FROM clanmembers WHERE idClan=?")->execute([$idClan]);
// Eliminar clan
$pdo->prepare("DELETE FROM clans WHERE id=?")->execute([$idClan]);

unset($_SESSION['idClan']);
$_SESSION['rolClan'] = null;

header("Location: clanSelect.php");
exit;
?>