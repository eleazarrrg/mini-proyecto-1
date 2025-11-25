<?php
use App\Utils\Validator as V;
use App\Utils\Math as M;
$out=null; $error=''; $text=$_POST['list']??'';
if($_SERVER['REQUEST_METHOD']==='POST'){
  try{
    $parts=array_filter(array_map('trim',explode(',',$text)),fn($x)=>$x!=='');
    if(!$parts) throw new InvalidArgumentException('Debe ingresar al menos un valor');
    $nums=[]; foreach($parts as $i=>$p){ if(!V::isNumeric($p)) throw new InvalidArgumentException("Valor inválido en posición ".($i+1)); $nums[]=V::toFloat($p); }
    $out=['n'=>count($nums),'prom'=>M::mean($nums),'desv'=>M::stddev($nums),'min'=>min($nums),'max'=>max($nums)];
  }catch(Throwable $e){ $error=$e->getMessage(); }
}
?>
<img src="public/assets/icon-stats.png" class="icon top-left" alt="">
<img src="public/assets/icon-magic.png" class="icon bottom-right" alt="">

<h3>📊 Misión p07 — Estadísticas de una lista</h3>

<form method="post">
  <label>Valores separados por coma (ej: 70, 85.5, 95)</label>
  <textarea name="list" rows="3"><?= h($text) ?></textarea>
  <button>Calcular</button>
</form>

<?php if($error): ?>
  <div class="result">Error: <?= h($error) ?></div>
<?php elseif($out): ?>
  <div class="result">
    <img src="public/assets/banner-dataset.png" alt="Dataset" style="width:100%;max-height:230px;object-fit:cover;border-radius:8px;margin-bottom:12px">
    <img src="public/assets/chart-lines.png" alt="Líneas" style="width:100%;max-height:180px;object-fit:cover;border-radius:8px;margin-bottom:12px;background:#eee">
    <table class="table animate-result">
      <tr><th>Cantidad</th><td><?= h($out['n']) ?></td></tr>
      <tr><th>Promedio</th><td><?= h(number_format($out['prom'],4)) ?></td></tr>
      <tr><th>Desv. Estándar</th><td><?= h(number_format($out['desv'],4)) ?></td></tr>
      <tr><th>Mínimo</th><td><?= h($out['min']) ?></td></tr>
      <tr><th>Máximo</th><td><?= h($out['max']) ?></td></tr>
    </table>
  </div>
<?php endif; ?>
