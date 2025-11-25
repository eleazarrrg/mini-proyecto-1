<?php
$sumP=0;$sumI=0; for($i=1;$i<=200;$i++){ ($i%2===0)?$sumP+=$i:$sumI+=$i; }
?>
<img src="public/assets/icon-sword.png" class="icon top-left" alt="">
<img src="public/assets/icon-magic.png" class="icon bottom-right" alt="">

<h3>🧮 Misión p04 — Suma pares vs impares (1..200)</h3>

<div class="result">
  <img src="public/assets/banner-even-odd.png" alt="Banner Pares/Impares" style="width:100%;max-height:230px;object-fit:cover;border-radius:8px;margin-bottom:12px">
  <img src="public/assets/even-odd-bars.png" alt="Barras pares/impares" style="width:100%;max-height:180px;object-fit:cover;border-radius:8px;margin-bottom:12px;background:#eee">
  <table class="table animate-result">
    <tr><th>Suma pares</th><td><?= h($sumP) ?></td></tr>
    <tr><th>Suma impares</th><td><?= h($sumI) ?></td></tr>
    <tr><th>Total</th><td><?= h($sumP+$sumI) ?></td></tr>
  </table>
</div>
