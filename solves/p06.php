<?php
use App\Utils\Validator as V;
$data=null; $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  try{
    $raw=$_POST['budget']??''; if(!V::isNumeric($raw)) throw new InvalidArgumentException('Presupuesto inválido');
    $B=V::toFloat($raw); V::requireInRange($B,0,1_000_000_000,'Presupuesto');
    $data=['Ginecología'=>$B*0.40,'Traumatología'=>$B*0.35,'Pediatría'=>$B*0.25];
  }catch(Throwable $e){ $error=$e->getMessage(); }
}
?>
<img src="public/assets/icon-sword.png" class="icon top-left" alt="">
<img src="public/assets/icon-magic.png" class="icon bottom-right" alt="">

<h3>🏥 Misión p06 — Presupuesto hospitalario</h3>

<form method="post">
  <label>Presupuesto anual (USD)</label>
  <input name="budget" value="<?= h($_POST['budget'] ?? '') ?>" required>
  <button>Distribuir</button>
</form>

<?php if($error): ?>
  <div class="result">Error: <?= h($error) ?></div>
<?php elseif($data): ?>
  <div class="result">
    <img src="public/assets/banner-hospital.png" alt="Hospital" style="width:100%;max-height:230px;object-fit:cover;border-radius:8px;margin-bottom:12px">
    <img src="public/assets/hospital-areas.png" alt="Áreas" style="width:100%;max-height:180px;object-fit:cover;border-radius:8px;margin-bottom:12px;background:#eee">
    <table class="table animate-result">
      <?php foreach($data as $area=>$m): ?>
        <tr><th><?= h($area) ?></th><td>$<?= h(number_format($m,2)) ?></td></tr>
      <?php endforeach; ?>
      <tr><th>Total</th><td>$<?= h(number_format(array_sum($data),2)) ?></td></tr>
    </table>
  </div>
<?php endif; ?>
