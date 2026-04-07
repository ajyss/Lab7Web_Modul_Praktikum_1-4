<!-- Alternatif tanpa View Cell -->
<!-- Ganti view_cell dengan ini di layout/main.php -->

<aside id="sidebar">
<?php
// Alternatif tanpa View Cell
$model = new \App\Models\ArtikelModel();
$artikel = $model->orderBy('created_at', 'DESC')->limit(5)->findAll();
?>
<div class="widget-box">
<h3 class="title">Artikel Terkini</h3>
<ul>
<?php foreach ($artikel as $row): ?>
<li><a href="<?= base_url('/artikel/' . $row['slug']) ?>"><?= $row['judul'] ?></a></li>
<?php endforeach; ?>
</ul>
</div>

<div class="widget-box">
<h3 class="title">Widget Header</h3>
<ul>
<li><a href="#">Widget Link</a></li>
<li><a href="#">Widget Link</a></li>
</ul>
</div>
<div class="widget-box">
<h3 class="title">Widget Text</h3>
<p>Vestibulum lorem elit, iaculis in nisl volutpat, malesuada tincidunt arcu.</p>
</div>
</aside>
