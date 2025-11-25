<?php
$sum = array_sum(range(1, 1000));
?>
<img src="public/assets/icon-sword.png" class="icon top-left" alt="sword">
<img src="public/assets/icon-magic.png" class="icon bottom-right" alt="magic">

<h3>⚔️ Misión p02 — Suma 1 .. 1000</h3>

<div class="result">
  <img src="public/assets/banner-sum.png" alt="Banner Suma" style="width:100%;max-height:240px;object-fit:cover;border-radius:8px;margin-bottom:12px">
  <img src="public/assets/sum-illustration.png" alt="Suma" style="width:100%;max-height:200px;object-fit:cover;border-radius:8px;margin-bottom:12px;background:#eee">
  <table class="table animate-result">
    <tr><th>Resultado</th><td><?= h($sum) ?></td></tr>
  </table>
</div>
