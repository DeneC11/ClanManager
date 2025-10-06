<?php
require 'conexion.php';
// usuario logueado
requireLogin();
// Obtener miembros del clan actual
$stmt = $pdo->prepare("
SELECT u.id, u.username, m.role
FROM clanmembers m
JOIN users u ON m.idUser = u.id
WHERE m.idClan = ?
ORDER BY m.role ASC, u.username ASC
");
$stmt->execute([$_SESSION['idClan']]);
$miembros = $stmt->fetchAll();
// print_r($miembros);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Partys - Clan Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .sticky-top {
      top: 0;
      /* asegura que quede pegado arriba */
    }

    .vh-100 {
      height: 100vh;
      /* ocupa toda la altura de la ventana */
    }

    .overflow-auto {
      overflow-y: auto;
      /* scroll si hay muchos miembros */
    }

    .dropzone {
      min-height: 150px;
      border: 2px dashed #666;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
    }

    .dropzone.dragover {
      border-color: #0d6efd;
      background-color: rgba(13, 110, 253, 0.1);
    }

    #miembros.dropzone {
      min-height: 200px;
      border: 2px dashed #666;
      padding: 10px;
      border-radius: 5px;
    }

    #miembros.dropzone.dragover {
      border-color: #0d6efd;
      background-color: rgba(13, 110, 253, 0.1);
    }
  </style>
</head>

<body class="bg-dark text-light">

  <?php include 'navbar.php'; ?>

  <header class="py-5 text-center">
    <h1><i class="bi bi-controller"></i> Partys de Guerra</h1>
    <p class="text-secondary">Crea y organiza grupos para raids y batallas.</p>
  </header>

  <div class="container-fluid">
    <div class="row">
      <!-- Columna izquierda fija -->
      <div class="col-md-3 bg-dark text-light vh-100 overflow-auto sticky-top">
        <h4 class="text-primary mt-3">Miembros del Clan</h4>
        <ul class="list-group dropzone bg-dark" id="miembros">
          <?php foreach ($miembros as $m): ?>
            <li class="list-group-item bg-dark text-light" draggable="true" id="user-<?= $m['id'] ?>">
              <?= htmlspecialchars($m['username']) ?> (<?= htmlspecialchars($m['role']) ?>)
            </li>
          <?php endforeach; ?>
        </ul>

      </div>

      <!-- Columna derecha dinámica -->
      <div class="col-md-9">
        <div class="mb-3 mt-3 d-flex align-items-end gap-3">
          <div>
            <label for="numPartys" class="form-label">Número de Partys</label>
            <input type="number" id="numPartys" class="form-control" value="2" min="1" max="12">
          </div>
          <div>
            <label for="limiteMiembros" class="form-label">Miembros por Party</label>
            <input type="number" id="limiteMiembros" class="form-control" value="5" min="1" max="10">
          </div>
        </div>
        <div class="row" id="partysContainer">
          <!-- Aquí se generan las partys -->
        </div>
      </div>
    </div>
  </div>


  <!-- Footer -->
  <?php include 'footer.php'; ?>
  <script>
    function getDistribution() {
      const distribution = {};
      document.querySelectorAll('.dropzone').forEach(zone => {
        const partyId = zone.id;
        distribution[partyId] = [];
        zone.querySelectorAll('li').forEach(li => {
          distribution[partyId].push(li.outerHTML); // guardamos el HTML del miembro
        });
      });
      return distribution;
    }

    function renderPartys(num) {
      const container = document.getElementById('partysContainer');
      const miembrosList = document.getElementById('miembros');
      const limiteMiembros = document.getElementById('limiteMiembros').value;

      // 1. Devolver todos los miembros de las partys a la lista de la izquierda
      document.querySelectorAll('.dropzone').forEach(zone => {
        if (zone.id !== 'miembros') { // no tocar la lista original
          zone.querySelectorAll('li').forEach(li => {
            miembrosList.appendChild(li);
          });
        }
      });

      // 2. Limpiar y regenerar las partys
      container.innerHTML = '';
      for (let i = 1; i <= num; i++) {
        const col = document.createElement('div');
        col.className = 'col-md-4';
        col.innerHTML = `
      <h4 class="text-success">Party ${i} (${limiteMiembros})</h4>
      <ul class="list-group dropzone bg-dark" id="party${i}"></ul>
    `;
        container.appendChild(col);
      }

      // 3. Reactivar drag & drop
      initDragDrop();
    }


    function initDragDrop() {
      const draggables = document.querySelectorAll('[draggable="true"]');
      const dropzones = document.querySelectorAll('.dropzone');

      draggables.forEach(item => {
        item.addEventListener('dragstart', e => {
          e.dataTransfer.setData('text/plain', e.target.id);
          e.target.classList.add('dragging');
        });
        item.addEventListener('dragend', e => {
          e.target.classList.remove('dragging');
        });
      });

      dropzones.forEach(zone => {
        zone.addEventListener('dragover', e => {
          e.preventDefault();
          zone.classList.add('dragover');
        });
        zone.addEventListener('dragleave', () => {
          zone.classList.remove('dragover');
        });
        zone.addEventListener('drop', e => {
          e.preventDefault();
          const id = e.dataTransfer.getData('text/plain');
          const dragging = document.getElementById(id);

          const limite = parseInt(document.getElementById('limiteMiembros').value);
          const miembrosActuales = zone.querySelectorAll('li').length;

          if (zone.id !== 'miembros' && miembrosActuales >= limite) {
            alert('Esta party ya alcanzó el límite de miembros.');
            return;
          }

          if (dragging) zone.appendChild(dragging);
          zone.classList.remove('dragover');
        });
      });
    }

    // inicializar con el valor por defecto
    renderPartys(document.getElementById('numPartys').value);

    // actualizar cuando cambie el número
    document.getElementById('numPartys').addEventListener('input', e => {
      renderPartys(e.target.value);
    });
    document.getElementById('limiteMiembros').addEventListener('input', () => {
      const numPartys = document.getElementById('numPartys').value;
      renderPartys(numPartys);
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>