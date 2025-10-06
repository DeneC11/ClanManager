<?php
require 'conexion.php';
requireLogin();

$idClan = $_SESSION['idClan'];
$rolActual = $_SESSION['rolClan'];

// Solo líder y oficiales pueden editar algo
if ($rolActual === 'miembro') {
    die("No tienes permisos para editar.");
}

// Actualizar roles de clan (solo líder)
if ($rolActual === 'lider' && !empty($_POST['clanRole'])) {
    foreach ($_POST['clanRole'] as $idUser => $newRole) {
        // Si se asigna un nuevo líder
        if ($newRole === 'lider') {
            // Actualizar tabla clans
            $stmt = $pdo->prepare("UPDATE clans SET idLeader = ? WHERE id = ?");
            $stmt->execute([$idUser, $idClan]);

            // Degradar al antiguo líder a oficial
            $stmt = $pdo->prepare("UPDATE clanmembers SET role = 'oficial' WHERE idUser = ? AND idClan = ?");
            $stmt->execute([$_SESSION['usuario_id'], $idClan]);

            // Actualizar sesión
            $_SESSION['rolClan'] = 'oficial';
        }

        // Actualizar rol en clanMembers
        $stmt = $pdo->prepare("UPDATE clanmembers SET role = ? WHERE idUser = ? AND idClan = ?");
        $stmt->execute([$newRole, $idUser, $idClan]);
    }
}

// Actualizar roles de juego (líder y oficiales)
if (!empty($_POST['gameRole'])) {
    foreach ($_POST['gameRole'] as $idUser => $gameRole) {
        $stmt = $pdo->prepare("UPDATE clanmembers SET gameRole = ? WHERE idUser = ? AND idClan = ?");
        $stmt->execute([$gameRole, $idUser, $idClan]);
    }
}

header("Location: clanMembers.php");
exit;
