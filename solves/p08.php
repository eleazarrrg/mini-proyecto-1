<?php
use App\Utils\Validator as V;
$station=''; $error=''; $raw=$_POST['date']??''; $img='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  try{
    $raw=V::sanitizeString($raw);
    $dt=DateTime::createFromFormat('Y-m-d',$raw);
    if(!$dt) throw new InvalidArgumentException('Fecha inválida');
    $m=(int)$dt->format('n'); $d=(int)$dt->format('j');
    if(($m==12&&$d>=21)||($m<=3&&($m<3||($m==3&&$d<20)))){ $station='Invierno'; $img='estacion-invierno.jpg'; }
    elseif(($m==3&&$d>=20)||($m<=6&&($m<6||($m==6&&$d<21)))){ $station='Primavera'; $img='estacion-primavera.jpg'; }
    elseif(($m==6&&$d>=21)||($m<=9&&($m<9||($m==9&&$d<23)))){ $station='Verano'; $img='estacion-verano.jpg'; }
    else { $station='Otoño'; $img='estacion-otono.jpg'; }
  }catch(Throwable $e){ $error=$e->getMessage(); }
}
?>
<img src="public/assets/icon-magic.png" class="icon top-left" alt="">
<img src="public/assets/icon-sword.png" class="icon bottom-right" alt="">

<h3>🌤️ Misión p08 — ¿Qué estación es?</h3>

<form method="post">
  <label>Fecha</label>
  <input type="date" name="date" value="<?= h($raw) ?>" required>
  <button>Mostrar</button>
</form>

<?php if($error): ?>
  <div class="result">Error: <?= h($error) ?></div>
<?php elseif($station!==''): ?>
  <div class="result">
    <img src="public/assets/banner-seasons.png" alt="Banner estaciones" style="width:100%;max-height:230px;object-fit:cover;border-radius:8px;margin-bottom:12px">
    <p>Fecha ingresada: <strong><?= h($raw) ?></strong></p>
    <p>La estación es: <strong><?= h($station) ?></strong></p>
    <img src="public/assets/<?= h($img) ?>" alt="<?= h($station) ?>" style="width:100%;max-height:280px;object-fit:cover;border-radius:8px;margin-top:8px">
  </div>
<?php endif; ?>
