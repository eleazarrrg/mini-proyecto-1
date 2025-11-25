<?php
use App\Utils\Validator as V;
use App\Data\SalesStore;

$msg=''; if(isset($_POST['reset'])){ SalesStore::reset(); }
if($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['op']??'')==='add'){
  try{
    $vRaw=$_POST['vend']??''; $pRaw=$_POST['prod']??''; $mRaw=$_POST['monto']??'';
    if(!V::isNumeric($vRaw)||!V::isNumeric($pRaw)||!V::isNumeric($mRaw)) throw new InvalidArgumentException('Datos inválidos');
    $vend=(int)V::toFloat($vRaw); $prod=(int)V::toFloat($pRaw); $monto=V::toFloat($mRaw);
    V::requireInRange($vend,1,4,'Vendedor'); V::requireInRange($prod,1,5,'Producto'); V::requireInRange($monto,0,1_000_000,'Monto');
    SalesStore::add($vend,$prod,$monto);
  }catch(Throwable $e){ $msg=$e->getMessage(); }
}
$T=SalesStore::table();
?>
<img src="public/assets/icon-sword.png" class="icon top-left" alt="">
<img src="public/assets/icon-magic.png" class="icon bottom-right" alt="">

<h3>💰 Misión p10 — Ventas por producto y vendedor</h3>

<form method="post" style="margin-bottom:16px;">
  <input type="hidden" name="op" value="add">
  <label>Vendedor (1..4)</label><input name="vend" value="<?= h($_POST['vend'] ?? '') ?>" required>
  <label>Producto (1..5)</label><input name="prod" value="<?= h($_POST['prod'] ?? '') ?>" required>
  <label>Monto (USD)</label><input name="monto" value="<?= h($_POST['monto'] ?? '') ?>" required>
  <button>Registrar</button>
</form>
<form method="post"><button name="reset" value="1">Reiniciar ventas</button></form>

<?php if($msg): ?><div class="result">Error: <?= h($msg) ?></div><?php endif; ?>

<div class="result">
  <img src="public/assets/banner-sales.png" alt="Banner ventas" style="width:100%;max-height:230px;object-fit:cover;border-radius:8px;margin-bottom:12px">
  <img src="public/assets/sales-chart.png" alt="Chart ventas" style="width:100%;max-height:180px;object-fit:cover;border-radius:8px;margin-bottom:12px;background:#eee">

  <table class="table animate-result">
    <tr>
      <th>Producto \\ Vendedor</th>
      <?php for($v=1;$v<=4;$v++): ?><th>V<?= $v ?></th><?php endfor; ?>
      <th>Total Producto</th>
    </tr>
    <?php $totalCols=array_fill(1,4,0.0); $granTotal=0.0; ?>
    <?php for($p=1;$p<=5;$p++): ?>
      <tr>
        <th>P<?= $p ?></th>
        <?php $rowTotal=0.0; for($v=1;$v<=4;$v++):
          $val=$T[$p][$v]; $rowTotal+=$val; $totalCols[$v]+=$val; ?>
          <td>$<?= h(number_format($val,2)) ?></td>
        <?php endfor; $granTotal+=$rowTotal; ?>
        <th>$<?= h(number_format($rowTotal,2)) ?></th>
      </tr>
    <?php endfor; ?>
    <tr>
      <th>Total Vendedor</th>
      <?php for($v=1;$v<=4;$v++): ?><th>$<?= h(number_format($totalCols[$v],2)) ?></th><?php endfor; ?>
      <th>$<?= h(number_format($granTotal,2)) ?></th>
    </tr>
  </table>
</div>
