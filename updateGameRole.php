<?php
require_once 'conexion.php';

$userId = $_SESSION['usuario_id'];
$newRole = $_POST['game_role'] ?? null;

$validRoles = ['tank', 'dps', 'heal'];

if (in_array($newRole, $validRoles)) {
  // Actualiza el rol de juego
  $sql = "UPDATE clanmembers SET gameRole = ? WHERE idUser = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$newRole, $userId]);
} elseif ($newRole === '') {
  // Si se selecciona "---", se borra el rol
  $sql = "UPDATE clanmembers SET gameRole = NULL WHERE idUser = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$userId]);
}

header("Location: profile.php");
exit;
?>