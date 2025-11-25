<?php
require __DIR__ . '/bootstrap.php';

$p = $_GET['p'] ?? '';
$valid = ['p01','p02','p03','p04','p05','p06','p07','p08','p09','p10'];
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Portal de Misiones — Reino Digital</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
  <div class="bg"></div>
  <div class="container">
    <div class="header">
      <h1>Portal de Misiones</h1>
      <p>Escoge una misión matemática/programática del reino digital</p>
    </div>

    <?php if ($p && in_array($p, $valid, true)): ?>
      <div class="panel animated-panel">
        <?php include __DIR__ . "/solves/{$p}.php"; ?>
      </div>
      <p><a href="index.php" class="btn-back">← Volver al portal</a></p>
    <?php else: ?>
      <div class="panel mission-panel">
        <h2>Misiones Disponibles</h2>
        <ul class="mission-list">
          <?php foreach ($valid as $v): ?>
            <li><a href="?p=<?= h($v) ?>" class="mission-link">Misión <?= strtoupper($v) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <div class="footer">
      Realizado por <strong>Alex de Boutaud</strong> & <strong>Rafael Gómez</strong>
    </div>
  </div>
</body>
</html>
