<?= $this->include('template/header'); ?>
<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>
<h3>Pertanyaan yang Sering Diajukan:</h3>
<ul>
<li><strong>Q: Apa itu CodeIgniter?</strong><br>
A: CodeIgniter adalah framework PHP yang ringan dan cepat untuk pengembangan web.</li>
<li><strong>Q: Bagaimana cara install CodeIgniter 4?</strong><br>
A: Anda dapat menginstall melalui Composer dengan perintah: composer create-project codeigniter4/appstarter</li>
<li><strong>Q: Apa itu MVC?</strong><br>
A: MVC (Model-View-Controller) adalah pattern arsitektur yang memisahkan logic, data, dan tampilan.</li>
<li><strong>Q: Dimana folder public pada CI4?</strong><br>
A: Folder public berisi file yang dapat diakses langsung oleh browser seperti CSS, JS, dan gambar.</li>
</ul>
<?= $this->include('template/footer'); ?>
