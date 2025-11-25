<?php
use App\Utils\Validator as V;
use App\Utils\Math as M;

$nums = [];
$out = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $inputs = [
            $_POST['n1'] ?? '', $_POST['n2'] ?? '',
            $_POST['n3'] ?? '', $_POST['n4'] ?? '',
            $_POST['n5'] ?? ''
        ];
        foreach ($inputs as $i => $raw) {
            if (!V::isNumeric($raw)) {
                throw new InvalidArgumentException("Valor #" . ($i + 1) . " inválido.");
            }
            $nums[] = V::toFloat($raw);
        }
        $out = [
            'media' => M::mean($nums),
            'desviacion' => M::stddev($nums),
            'min' => min($nums),
            'max' => max($nums),
        ];
    } catch (Throwable $e) {
        $error = $e->getMessage();
    }
}
?>
<!-- Icono decorativo estadístico -->
<img src="public/assets/icon-stats.png" class="icon top-left" alt="Estadísticas">
<img src="public/assets/icon-magic.png" class="icon bottom-right" alt="Hechizo">


<h3>🔢 Misión p01 — Estadísticas de 5 números</h3>

<form method="post">
  <div style="display:grid; grid-template-columns:repeat(5,1fr); gap:8px;">
    <?php for ($i = 1; $i <= 5; $i++): ?>
      <div>
        <label>n<?= $i ?></label>
        <input name="n<?= $i ?>" value="<?= h($_POST["n$i"] ?? '') ?>" required>
      </div>
    <?php endfor; ?>
  </div>
  <button>Calcular estadísticas</button>
</form>

<?php if ($error): ?>
  <div class="result">Error: <?= h($error) ?></div>
<?php elseif ($out): ?>
  <div class="result">
    <!-- Puedes poner banner decorativo -->
    <img src="public/assets/banner-stats.png" alt="Gráfico" style="width:100%; margin-bottom:12px; border-radius:8px;">

    <p><strong>Datos ingresados:</strong> <?= h(implode(', ', $nums)) ?></p>
    <table class="table animate-result">
      <tr><th>Media</th><td><?= h(number_format($out['media'], 4)) ?></td></tr>
      <tr><th>Desviación estándar</th><td><?= h(number_format($out['desviacion'], 4)) ?></td></tr>
      <tr><th>Mínimo</th><td><?= h($out['min']) ?></td></tr>
      <tr><th>Máximo</th><td><?= h($out['max']) ?></td></tr>
    </table>
  </div>
<?php endif; ?>
