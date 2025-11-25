<?php
use App\Utils\Validator as V;
$cats=['Niño'=>0,'Adolescente'=>0,'Adulto'=>0,'Adulto mayor'=>0];
$rows=[]; $done=false; $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  try{
    for($i=1;$i<=5;$i++){
      $raw=$_POST["e$i"]??''; if(!V::isNumeric($raw)) throw new InvalidArgumentException("Edad #$i inválida");
      $age=(int)V::toFloat($raw); V::requireInRange($age,0,120,"Edad #$i");
      $cat=($age<=12)?'Niño':(($age<=17)?'Adolescente':(($age<=64)?'Adulto':'Adulto mayor'));
      $cats[$cat]++; $rows[]=['#'=>$i,'edad'=>$age,'cat'=>$cat];
    } $done=true;
  }catch(Throwable $e){ $error=$e->getMessage(); }
}
?>
<img src="public/assets/icon-sword.png" class="icon top-left" alt="">
<img src="public/assets/icon-magic.png" class="icon bottom-right" alt="">

<h3>👥 Misión p05 — Clasificar edades</h3>

<form method="post">
  <div style="display:grid;grid-template-columns:repeat(5,1fr);gap:8px;">
    <?php for($i=1;$i<=5;$i++): ?>
      <div><label>Edad #<?= $i ?></label><input name="e<?= $i ?>" value="<?= h($_POST["e$i"] ?? '') ?>" required></div>
    <?php endfor; ?>
  </div>
  <button>Clasificar</button>
</form>

<?php if($error): ?>
  <div class="result">Error: <?= h($error) ?></div>
<?php elseif($done): ?>
  <div class="result">
    <img src="public/assets/banner-ages.png" alt="Banner edades" style="width:100%;max-height:230px;object-fit:cover;border-radius:8px;margin-bottom:12px">
    <img src="public/assets/ages-icons.png" alt="Íconos edades" style="width:100%;max-height:160px;object-fit:contain;border-radius:8px;margin-bottom:12px;background:#fff">
    <table class="table animate-result">
      <tr><th>#</th><th>Edad</th><th>Categoría</th></tr>
      <?php foreach($rows as $r): ?>
        <tr><td><?= h($r['#']) ?></td><td><?= h($r['edad']) ?></td><td><?= h($r['cat']) ?></td></tr>
      <?php endforeach; ?>
      <tr><th colspan="3">Resumen</th></tr>
      <?php foreach($cats as $k=>$v): ?>
        <tr><td colspan="2"><?= h($k) ?></td><td><?= h($v) ?></td></tr>
      <?php endforeach; ?>
    </table>
  </div>
<?php endif; ?>
