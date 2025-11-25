<?php
use App\Utils\Validator as V;
$out=[]; $error=''; $raw=$_POST['n']??'';
if($_SERVER['REQUEST_METHOD']==='POST'){
  try{
    if(!V::isNumeric($raw)) throw new InvalidArgumentException('Número inválido');
    $n=(int)V::toFloat($raw); V::requireInRange($n,1,9,'Número');
    for($p=1;$p<=15;$p++){ $out[] = "{$n}^{$p} = ".($n**$p); }
  }catch(Throwable $e){ $error=$e->getMessage(); }
}
?>
<img src="public/assets/icon-sword.png" class="icon top-left" alt="">
<img src="public/assets/icon-magic.png" class="icon bottom-right" alt="">

<h3>✨ Misión p09 — Potencias (1..9)</h3>

<form method="post">
  <label>Número (1..9)</label>
  <input name="n" value="<?= h($raw) ?>" required>
  <button>Generar</button>
</form>

<?php if($error): ?>
  <div class="result">Error: <?= h($error) ?></div>
<?php elseif($out): ?>
  <div class="result">
    <img src="public/assets/banner-powers.png" alt="Banner potencias" style="width:100%;max-height:230px;object-fit:cover;border-radius:8px;margin-bottom:12px">
    <img src="public/assets/power-rays.png" alt="Rayos" style="width:100%;max-height:180px;object-fit:cover;border-radius:8px;margin-bottom:12px;background:#eee">
    <p><?= h(implode('<br>', $out)) ?></p>
  </div>
<?php endif; ?>
