<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>
<p>Anda dapat menghubungi kami melalui:</p>
<ul>
<li>Email: info@pelitabangsa.ac.id</li>
<li>Telepon: (021) 1234-5678</li>
<li>Alamat: Jl. Contoh No. 123, Bekasi</li>
</ul>
<?= $this->endSection() ?>
