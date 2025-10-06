<?php
require 'conexion.php';
requireLogin();

$idClan = $_SESSION['idClan'];
$idUser = $_SESSION['usuario_id'];

if ($_SESSION['rolClan'] === 'lider') {
  die("El líder no puede abandonar el clan, debe eliminarlo.");
}

$pdo->prepare("DELETE FROM clanmembers WHERE idClan=? AND idUser=?")->execute([$idClan, $idUser]);

unset($_SESSION['idClan']);
$_SESSION['rolClan'] = null;

header("Location: clanSelect.php");
exit;
?>