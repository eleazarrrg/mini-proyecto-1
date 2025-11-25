<?php
use App\Utils\Validator as V;
$list = []; $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $raw = $_POST['n'] ?? '';
    if (!V::isNumeric($raw)) throw new InvalidArgumentException('N inválido');
    $n = (int)V::toFloat($raw);
    V::requireInRange($n, 1, 200, 'N');
    for ($i=1;$i<=$n;$i++) { $list[] = 4*$i; }
  } catch (Throwable $e) { $error = $e->getMessage(); }
}
?>
<img src="public/assets/icon-sword.png" class="icon top-left" alt="">
<img src="public/assets/icon-magic.png" class="icon bottom-right" alt="">

<h3>🔢 Misión p03 — Múltiplos de 4</h3>

<form method="post">
  <label>Cantidad de múltiplos (1..200)</label>
  <input name="n" value="<?= h($_POST['n'] ?? '') ?>" required>
  <button>Generar</button>
</form>

<?php if ($error): ?>
  <div class="result">Error: <?= h($error) ?></div>
<?php elseif ($list): ?>
  <div class="result">
    <img src="public/assets/banner-multiples.png" alt="Banner Múltiplos" style="width:100%;max-height:230px;object-fit:cover;border-radius:8px;margin-bottom:12px">
    <img src="public/assets/icon-4x.png" alt="4x" style="width:100%;max-height:160px;object-fit:contain;border-radius:8px;margin-bottom:12px;background:#fff">
    <p><?= h(implode(', ', $list)) ?></p>
  </div>
<?php endif; ?>
