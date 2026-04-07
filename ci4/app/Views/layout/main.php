<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $title ?? 'My Website' ?></title>
<link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>
<body>
<div id="container">
<header>
<h1>Layout Sederhana</h1>
</header>
<nav>
<a href="<?= base_url('/');?>" class="active">Home</a>
<a href="<?= base_url('/artikel');?>">Artikel</a>
<a href="<?= base_url('/about');?>">About</a>
<a href="<?= base_url('/contact');?>">Kontak</a>

<?php if(session()->get('logged_in')): ?>
    <div class="nav-user" style="float: right;">
        <span style="color: #fff; margin-right: 1rem;">
            Welcome, <strong><?= session()->get('user_name'); ?></strong>
        </span>
        <a href="<?= base_url('/admin/artikel'); ?>" class="btn-nav">Admin</a>
        <a href="<?= base_url('/user/logout'); ?>" class="btn-nav btn-danger">Logout</a>
    </div>
<?php else: ?>
    <div class="nav-login" style="float: right;">
        <a href="<?= base_url('/user/login'); ?>" class="btn-nav btn-login">Login</a>
    </div>
<?php endif; ?>
</nav>

<style>
.nav-login, .nav-user {
    margin-right: 2rem;
}

.btn-nav {
    background: rgba(255,255,255,0.2);
    color: #fff;
    padding: 0.5rem 1rem;
    text-decoration: none;
    border-radius: 5px;
    margin-left: 0.5rem;
    font-size: 0.9rem;
    transition: all 0.3s;
    border: 1px solid rgba(255,255,255,0.3);
}

.btn-nav:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-2px);
}

.btn-login {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    font-weight: bold;
}

.btn-login:hover {
    background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

.btn-danger {
    background: rgba(220,53,69,0.8) !important;
    border: 1px solid rgba(220,53,69,0.9) !important;
}

.btn-danger:hover {
    background: rgba(220,53,69,0.9) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .nav-login, .nav-user {
        float: none;
        text-align: center;
        margin: 1rem 0;
        margin-right: 2rem;
    }
    
    nav {
        padding-bottom: 1rem;
    }
}
</style>
<section id="wrapper">
<section id="main">

<?= $this->renderSection('content') ?>
</section>
<aside id="sidebar">
<?php if(!session()->get('logged_in')): ?>
<div class="widget-box login-widget">
<h3 class="title">Admin Login</h3>
<p>Login untuk mengelola artikel</p>
<a href="<?= base_url('/user/login'); ?>" class="btn btn-block btn-gradient">
    <span class="icon">?</span> Login Admin
</a>
</div>
<?php endif; ?>

<?php
// Coba ambil artikel terkini dengan error handling
try {
    $model = new \App\Models\ArtikelModel();
    $artikel = $model->orderBy('id', 'DESC')->limit(5)->findAll();
    echo view('components/artikel_terkini', ['artikel' => $artikel]);
} catch (\Exception $e) {
    // Tampilkan widget default jika database belum siap
    echo '<div class="widget-box">';
    echo '<h3 class="title">Artikel Terkini</h3>';
    echo '<p><em>Database belum siap. Silakan setup database terlebih dahulu.</em></p>';
    echo '</div>';
}
?>

<div class="widget-box">
<h3 class="title">Widget Header</h3>
<ul>
<li><a href="#">Widget Link</a></li>
<li><a href="#">Widget Link</a></li>
</ul>
</div>
<div class="widget-box">
<h3 class="title">Widget Text</h3>
<p>Vestibulum lorem elit, iaculis in nisl volutpat,
malesuada tincidunt arcu. Proin in leo fringilla, vestibulum mi porta,
faucibus felis. Integer pharetra est nunc, nec pretium nunc pretium ac.</p>
</div>
</aside>

<style>
.login-widget {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-align: center;
    margin-bottom: 1.5rem;
}

.login-widget .title {
    color: white;
    border-bottom: 1px solid rgba(255,255,255,0.3);
}

.login-widget p {
    margin-bottom: 1rem;
    opacity: 0.9;
}

.btn-block {
    display: block;
    width: 100%;
    text-align: center;
}

.btn-gradient {
    background: rgba(255,255,255,0.2);
    color: white;
    padding: 0.75rem 1rem;
    text-decoration: none;
    border-radius: 8px;
    border: 1px solid rgba(255,255,255,0.3);
    transition: all 0.3s;
    font-weight: bold;
}

.btn-gradient:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.icon {
    margin-right: 0.5rem;
}
</style>
</section>
<footer>
<p>&copy; 2021 - Universitas Pelita Bangsa</p>
</footer>
</div>
</body>
</html>
