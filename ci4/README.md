# Laporan Praktikum Pemrograman Web 2
## CodeIgniter 4 Framework - Praktikum 1-4

**Nama:** Aziz Tri Ramadhan  
**NIM:** [Your NIM]  
**Mata Kuliah:** Pemrograman Web 2  
**Dosen:** Agung Nugroho, S.Kom., M.Kom.  
**Universitas Pelita Bangsa**

---

## Daftar Isi

1. [Praktikum 1: Pengenalan CodeIgniter 4](#praktikum-1)
2. [Praktikum 2: Framework Lanjutan (CRUD)](#praktikum-2)
3. [Praktikum 3: View Layout dan View Cell](#praktikum-3)
4. [Praktikum 4: Framework Lanjutan (Modul Login)](#praktikum-4)
5. [Kesimpulan dan Pembelajaran](#kesimpulan)

---

## Praktikum 1: Pengenalan CodeIgniter 4

### Tujuan
- Memahami struktur direktori CodeIgniter 4
- Mengkonfigurasi environment development
- Memahami konsep MVC (Model-View-Controller)
- Membuat routing dan controller dasar

### Langkah 1: Setup Environment

#### 1.1 Mengaktifkan Mode Development
```bash
# Ubah nama file env menjadi .env
mv env .env

# Edit file .env
CI_ENVIRONMENT = development
```

**Screenshot 1.1: Konfigurasi Environment**
![Environment Setup](screenshots/1_1_environment_setup.png)

#### 1.2 Struktur Direktori CodeIgniter 4
```
lab11_ci/ci4/
|-- app/                    # Kode aplikasi
|-- public/                 # File publik (CSS, JS, images)
|-- writable/               # File yang dapat ditulis (logs, cache)
|-- tests/                  # Unit testing
|-- vendor/                 # Library dependencies
|-- .env                    # Konfigurasi environment
|-- .gitignore              # File yang diabaikan Git
|-- spark                   # CLI tool
```

**Screenshot 1.2: Struktur Direktori**
![Directory Structure](screenshots/1_2_directory_structure.png)

### Langkah 2: Memahami Konsep MVC

**Model:** Data layer - mengelola data dan database  
**View:** Presentation layer - menangani tampilan UI  
**Controller:** Business logic - menghubungkan Model dan View

### Langkah 3: Routing dan Controller

#### 3.1 Konfigurasi Routing
File: `app/Config/Routes.php`
```php
// Route default
$routes->get('/', 'Home::index');

// Route baru
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
```

**Screenshot 1.3: Konfigurasi Routes**
![Routes Configuration](screenshots/1_3_routes_config.png)

#### 3.2 Verifikasi Routes
```bash
php spark routes
```

**Screenshot 1.4: Verifikasi Routes di CLI**
![Routes CLI](screenshots/1_4_routes_cli.png)

#### 3.3 Membuat Controller Page
File: `app/Controllers/Page.php`
```php
<?php
namespace App\Controllers;

class Page extends BaseController
{
    public function about()
    {
        echo "Ini halaman About";
    }
    
    public function contact()
    {
        echo "Ini halaman Contact";
    }
    
    public function faqs()
    {
        echo "Ini halaman FAQ";
    }
}
```

**Screenshot 1.5: Controller Page**
![Page Controller](screenshots/1_5_page_controller.png)

### Langkah 4: Auto Routing

#### 4.1 Mengaktifkan Auto Routing
```php
// app/Config/Routes.php
$routes->setAutoRoute(true);
```

#### 4.2 Menambah Method Baru
```php
public function tos()
{
    echo "ini halaman Term of Services";
}
```

**Screenshot 1.6: Auto Routing Test**
![Auto Routing](screenshots/1_6_auto_routing.png)

### Langkah 5: Membuat View

#### 5.1 View About
File: `app/Views/about.php`
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
</head>
<body>
    <h1><?= $title; ?></h1>
    <hr>
    <p><?= $content; ?></p>
</body>
</html>
```

#### 5.2 Update Controller
```php
public function about()
{
    return view('about', [
        'title' => 'Halaman About',
        'content' => 'Ini adalah halaman about yang menjelaskan tentang isi halaman ini.'
    ]);
}
```

**Screenshot 1.7: View About dengan Data**
![About View](screenshots/1_7_about_view.png)

### Langkah 6: Layout dengan CSS

#### 6.1 Struktur Asset
```
public/
|-- style.css              # File CSS
|-- gambar/                # Folder gambar
```

**Screenshot 1.8: Struktur Asset**
![Asset Structure](screenshots/1_8_asset_structure.png)

#### 6.2 Template Header & Footer
File: `app/Views/template/header.php`
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
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
</nav>
<section id="wrapper">
<section id="main">
```

#### 6.3 View dengan Template
File: `app/Views/about.php`
```php
<?= $this->include('template/header'); ?>
<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>
<?= $this->include('template/footer'); ?>
```

**Screenshot 1.9: Final Layout About**
![Final About Layout](screenshots/1_9_final_about.png)

---

## Praktikum 2: Framework Lanjutan (CRUD)

### Tujuan
- Memahami konsep Model untuk database
- Membuat CRUD (Create, Read, Update, Delete)
- Mengimplementasikan form validation
- Mengelola database dengan CodeIgniter 4

### Langkah 1: Persiapan Database

#### 1.1 Membuat Database
```sql
CREATE DATABASE lab_ci4;
```

#### 1.2 Membuat Tabel Artikel
```sql
CREATE TABLE artikel (
    id INT(11) auto_increment,
    judul VARCHAR(200) NOT NULL,
    isi TEXT,
    gambar VARCHAR(200),
    status TINYINT(1) DEFAULT 0,
    slug VARCHAR(200),
    PRIMARY KEY(id)
);
```

**Screenshot 2.1: Struktur Tabel Artikel**
![Artikel Table Structure](screenshots/2_1_artikel_table.png)

### Langkah 2: Konfigurasi Database

#### 2.1 File .env
```env
database.default.hostname = localhost
database.default.database = lab_ci4
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

**Screenshot 2.2: Konfigurasi Database**
![Database Config](screenshots/2_2_database_config.png)

### Langkah 3: Membuat Model

File: `app/Models/ArtikelModel.php`
```php
<?php
namespace App\Models;
use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'isi', 'status', 'slug', 'gambar'];
}
```

**Screenshot 2.3: ArtikelModel**
![Artikel Model](screenshots/2_3_artikel_model.png)

### Langkah 4: Membuat Controller

File: `app/Controllers/Artikel.php`
```php
<?php
namespace App\Controllers;
use App\Models\ArtikelModel;

class Artikel extends BaseController
{
    public function index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $artikel = $model->findAll();
        return view('artikel/index', compact('artikel', 'title'));
    }
}
```

**Screenshot 2.4: Artikel Controller**
![Artikel Controller](screenshots/2_4_artikel_controller.png)

### Langkah 5: Membuat View

#### 5.1 View Index Artikel
File: `app/Views/artikel/index.php`
```php
<?= $this->include('template/header'); ?>
<?php if($artikel): foreach($artikel as $row): ?>
<article class="entry">
    <h2><a href="<?= base_url('/artikel/' . $row['slug']);?>"><?= $row['judul']; ?></a></h2>
    <img src="<?= base_url('/gambar/' . $row['gambar']);?>" alt="<?= $row['judul']; ?>">
    <p><?= substr($row['isi'], 0, 200); ?></p>
</article>
<hr class="divider" />
<?php endforeach; else: ?>
<article class="entry">
    <h2>Belum ada data.</h2>
</article>
<?php endif; ?>
<?= $this->include('template/footer'); ?>
```

**Screenshot 2.5: View Artikel Index**
![Artikel Index View](screenshots/2_5_artikel_index.png)

### Langkah 6: Menambah Data Dummy

```sql
INSERT INTO artikel (judul, isi, slug) VALUES
('Artikel pertama', 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan...', 'artikel-pertama'),
('Artikel kedua', 'Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak...', 'artikel-kedua');
```

**Screenshot 2.6: Artikel dengan Data**
![Artikel with Data](screenshots/2_6_artikel_with_data.png)

### Langkah 7: Detail Artikel

#### 7.1 Method View di Controller
```php
public function view($slug)
{
    $model = new ArtikelModel();
    $artikel = $model->where(['slug' => $slug])->first();
    
    if (!$artikel) {
        throw PageNotFoundException::forPageNotFound();
    }
    
    $title = $artikel['judul'];
    return view('artikel/detail', compact('artikel', 'title'));
}
```

#### 7.2 View Detail
File: `app/Views/artikel/detail.php`
```php
<?= $this->include('template/header'); ?>
<article class="entry">
    <h2><?= $artikel['judul']; ?></h2>
    <img src="<?= base_url('/gambar/' . $artikel['gambar']);?>" alt="<?= $artikel['judul']; ?>">
    <p><?= $artikel['isi']; ?></p>
</article>
<?= $this->include('template/footer'); ?>
```

**Screenshot 2.7: Detail Artikel**
![Artikel Detail](screenshots/2_7_artikel_detail.png)

### Langkah 8: Menu Admin

#### 8.1 Admin Index Method
```php
public function admin_index()
{
    $title = 'Daftar Artikel';
    $model = new ArtikelModel();
    $artikel = $model->findAll();
    return view('artikel/admin_index', compact('artikel', 'title'));
}
```

#### 8.2 Admin Routes
```php
$routes->group('admin', function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});
```

**Screenshot 2.8: Admin Index**
![Admin Index](screenshots/2_8_admin_index.png)

### Langkah 9: CRUD Operations

#### 9.1 Create (Tambah Artikel)
```php
public function add()
{
    $validation = \Config\Services::validation();
    $validation->setRules(['judul' => 'required']);
    $isDataValid = $validation->withRequest($this->request)->run();
    
    if ($isDataValid) {
        $artikel = new ArtikelModel();
        $artikel->insert([
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'slug' => url_title($this->request->getPost('judul')),
        ]);
        return redirect('admin/artikel');
    }
    
    $title = "Tambah Artikel";
    return view('artikel/form_add', compact('title'));
}
```

**Screenshot 2.9: Form Tambah Artikel**
![Add Article Form](screenshots/2_9_add_article.png)

#### 9.2 Update (Edit Artikel)
```php
public function edit($id)
{
    $artikel = new ArtikelModel();
    $validation = \Config\Services::validation();
    $validation->setRules(['judul' => 'required']);
    $isDataValid = $validation->withRequest($this->request)->run();
    
    if ($isDataValid) {
        $artikel->update($id, [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
        ]);
        return redirect('admin/artikel');
    }
    
    $data = $artikel->where('id', $id)->first();
    $title = "Edit Artikel";
    return view('artikel/form_edit', compact('title', 'data'));
}
```

**Screenshot 2.10: Form Edit Artikel**
![Edit Article Form](screenshots/2_10_edit_article.png)

#### 9.3 Delete (Hapus Artikel)
```php
public function delete($id)
{
    $artikel = new ArtikelModel();
    $artikel->delete($id);
    return redirect('admin/artikel');
}
```

---

## Praktikum 3: View Layout dan View Cell

### Tujuan
- Memahami konsep View Layout di CodeIgniter 4
- Menggunakan View Layout untuk template tampilan
- Mengimplementasikan View Cell untuk komponen modular
- Membuat sidebar dengan data dinamis

### Langkah 1: Membuat Layout Utama

#### 1.1 Layout Main
File: `app/Views/layout/main.php`
```php
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
</nav>
<section id="wrapper">
<section id="main">

<?= $this->renderSection('content') ?>
</section>
<aside id="sidebar">
<?= view_cell('App\\Cells\\ArtikelTerkini::render') ?>
<div class="widget-box">
<h3 class="title">Widget Header</h3>
<ul>
<li><a href="#">Widget Link</a></li>
<li><a href="#">Widget Link</a></li>
</ul>
</div>
<div class="widget-box">
<h3 class="title">Widget Text</h3>
<p>Vestibulum lorem elit, iaculis in nisl volutpat, malesuada tincidunt arcu...</p>
</div>
</aside>
</section>
<footer>
<p>&copy; 2021 - Universitas Pelita Bangsa</p>
</footer>
</div>
</body>
</html>
```

**Screenshot 3.1: Layout Main Structure**
![Layout Main](screenshots/3_1_layout_main.png)

### Langkah 2: Modifikasi View dengan Layout

#### 2.1 View Home dengan Layout
File: `app/Views/home.php`
```php
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>
<?= $this->endSection() ?>
```

**Screenshot 3.2: View dengan Layout**
![View with Layout](screenshots/3_2_view_layout.png)

### Langkah 3: View Cell untuk Sidebar Dinamis

#### 3.1 Membuat View Cell Class
File: `app/Cells/ArtikelTerkini.php`
```php
<?php
namespace App\Cells;
use CodeIgniter\View\Cell;
use App\Models\ArtikelModel;

class ArtikelTerkini extends Cell
{
    public function render()
    {
        $model = new ArtikelModel();
        $artikel = $model->orderBy('created_at', 'DESC')->limit(5)->findAll();
        return view('components/artikel_terkini', ['artikel' => $artikel]);
    }
}
```

**Screenshot 3.3: View Cell Class**
![View Cell Class](screenshots/3_3_view_cell_class.png)

#### 3.2 Komponen View Cell
File: `app/Views/components/artikel_terkini.php`
```php
<h3>Artikel Terkini</h3>
<ul>
<?php foreach ($artikel as $row): ?>
<li><a href="<?= base_url('/artikel/' . $row['slug']) ?>"><?= $row['judul'] ?></a></li>
<?php endforeach; ?>
</ul>
```

**Screenshot 3.4: View Cell Component**
![View Cell Component](screenshots/3_4_view_cell_component.png)

### Langkah 4: Database Update untuk created_at

#### 4.1 Update Tabel Artikel
```sql
ALTER TABLE artikel ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
```

**Screenshot 3.5: Updated Table Structure**
![Updated Table](screenshots/3_5_updated_table.png)

### Langkah 5: Testing View Layout

**Screenshot 3.6: Final Layout dengan View Cell**
![Final Layout with View Cell](screenshots/3_6_final_layout.png)

---

## Praktikum 4: Framework Lanjutan (Modul Login)

### Tujuan
- Memahami konsep Authentication dan Filter
- Membuat sistem login dengan CodeIgniter 4
- Mengimplementasikan session management
- Melindungi halaman admin dengan filter

### Langkah 1: Database Setup

#### 1.1 Membuat Tabel User
```sql
CREATE TABLE user (
    id INT(11) auto_increment,
    username VARCHAR(200) NOT NULL,
    useremail VARCHAR(200),
    userpassword VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active TINYINT(1) DEFAULT 1,
    PRIMARY KEY(id)
);
```

**Screenshot 4.1: User Table Structure**
![User Table](screenshots/4_1_user_table.png)

### Langkah 2: Membuat User Model

File: `app/Models/UserModel.php`
```php
<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['username', 'useremail', 'userpassword', 'last_login', 'is_active'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';
    
    public function getUserByEmail($email)
    {
        return $this->where('useremail', $email)
                       ->where('is_active', 1)
                       ->first();
    }
    
    public function updateLastLogin($userId)
    {
        return $this->update($userId, ['last_login' => date('Y-m-d H:i:s')]);
    }
}
```

**Screenshot 4.2: User Model**
![User Model](screenshots/4_2_user_model.png)

### Langkah 3: Membuat User Controller

File: `app/Controllers/User.php`
```php
<?php
namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function login()
    {
        helper(['form']);
        
        if (session()->get('logged_in')) {
            return redirect('admin/artikel');
        }
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        if (!$email) {
            return view('user/login');
        }
        
        $session = session();
        $model = new UserModel();
        $login = $model->getUserByEmail($email);
        
        if ($login) {
            $pass = $login['userpassword'];
            if (password_verify($password, $pass)) {
                $model->updateLastLogin($login['id']);
                
                $login_data = [
                    'user_id' => $login['id'],
                    'user_name' => $login['username'],
                    'user_email' => $login['useremail'],
                    'logged_in' => TRUE,
                    'login_time' => time(),
                ];
                
                $session->set($login_data);
                return redirect('admin/artikel');
            } else {
                $session->setFlashdata("flash_msg", "Password salah.");
                return redirect()->to('/user/login');
            }
        } else {
            $session->setFlashdata("flash_msg", "Email tidak terdaftar.");
            return redirect()->to('/user/login');
        }
    }
    
    public function logout()
    {
        $session = session();
        $userName = $session->get('user_name');
        $this->logActivity('User logged out: ' . $userName);
        $session->destroy();
        return redirect()->to('/user/login');
    }
}
```

**Screenshot 4.3: User Controller**
![User Controller](screenshots/4_3_user_controller.png)

### Langkah 4: Membuat Login View

File: `app/Views/user/login.php`
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>
<body>
<div id="login-wrapper">
    <h1>Sign In</h1>
    <?php if(session()->getFlashdata('flash_msg')):?>
        <div class="alert alert-danger"><?= session()->getFlashdata('flash_msg') ?></div>
    <?php endif;?>
    <form action="" method="post">
        <div class="mb-3">
            <label for="InputForEmail" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="InputForEmail" value="<?= set_value('email') ?>">
        </div>
        <div class="mb-3">
            <label for="InputForPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="InputForPassword">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</body>
</html>
```

**Screenshot 4.4: Login Form**
![Login Form](screenshots/4_4_login_form.png)

### Langkah 5: Database Seeder

#### 5.1 Membuat Seeder
```bash
php spark make:seeder UserSeeder
```

#### 5.2 UserSeeder Code
File: `app/Database/Seeds/UserSeeder.php`
```php
<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model = model('UserModel');
        $model->insert([
            'username' => 'admin',
            'useremail' => 'aziztriramadhan29@gmail.com',
            'userpassword' => password_hash('admin123', PASSWORD_DEFAULT),
        ]);
    }
}
```

#### 5.3 Jalankan Seeder
```bash
php spark db:seed UserSeeder
```

**Screenshot 4.5: Database Seeder**
![Database Seeder](screenshots/4_5_database_seeder.png)

### Langkah 6: Auth Filter

#### 6.1 Membuat Filter
File: `app/Filters/Auth.php`
```php
<?php namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(! session()->get('logged_in')){
            return redirect()->to('/user/login');
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
```

**Screenshot 4.6: Auth Filter**
![Auth Filter](screenshots/4_6_auth_filter.png)

#### 6.2 Konfigurasi Filter
File: `app/Config/Filters.php`
```php
'auth' => App\Filters\Auth::class
```

#### 6.3 Protected Routes
File: `app/Config/Routes.php`
```php
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});
```

**Screenshot 4.7: Protected Routes**
![Protected Routes](screenshots/4_7_protected_routes.png)

### Langkah 7: Testing Auth System

#### 7.1 Akses Admin Tanpa Login
**Screenshot 4.8: Redirect to Login**
![Redirect to Login](screenshots/4_8_redirect_login.png)

#### 7.2 Login Berhasil
**Screenshot 4.9: Login Success**
![Login Success](screenshots/4_9_login_success.png)

### Langkah 8: Improvisasi (Bonus)

#### 8.1 User Dashboard
File: `app/Views/user/dashboard.php`
```php
<?= $this->extend('template/admin_header'); ?>
<?= $this->section('content') ?>
<div class="dashboard-header">
    <h1>Welcome, <?= session()->get('user_name'); ?>!</h1>
    <p class="subtitle">User Dashboard - Manage Your Account</p>
</div>

<div class="dashboard-stats">
    <div class="stat-card">
        <h3>Total Users</h3>
        <div class="stat-number"><?= $totalUsers; ?></div>
        <p>Registered users</p>
    </div>
    
    <div class="stat-card">
        <h3>Your Role</h3>
        <div class="stat-number"><?= ucfirst(session()->get('user_name')); ?></div>
        <p>Account type</p>
    </div>
</div>
<?= $this->endSection() ?>
```

#### 8.2 Activity Logging
```php
private function logActivity($activity)
{
    $logFile = WRITEPATH . 'logs/user_activity.log';
    $timestamp = date('Y-m-d H:i:s');
    $ip = $this->request->getIPAddress();
    $logMessage = "[{$timestamp}] [{$ip}] {$activity}\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
}
```

**Screenshot 4.10: User Dashboard**
![User Dashboard](screenshots/4_10_user_dashboard.png)

---

## Kesimpulan dan Pembelajaran

### Apa yang Dipelajari

1. **Praktikum 1:** 
   - Struktur CodeIgniter 4
   - Konsep MVC
   - Routing dan Controller
   - View dengan Template

2. **Praktikum 2:**
   - Database integration
   - Model untuk data management
   - CRUD operations
   - Form validation

3. **Praktikum 3:**
   - View Layout system
   - View Cell untuk komponen modular
   - Template inheritance
   - Dynamic sidebar

4. **Praktikum 4:**
   - Authentication system
   - Session management
   - Filter for route protection
   - Database seeder

### Tantangan dan Solusi

1. **Database Connection:** Konfigurasi .env untuk koneksi database
2. **Password Hashing:** Menggunakan password_hash() untuk keamanan
3. **Route Protection:** Implementasi filter untuk proteksi halaman admin
4. **Template Reusability:** Menggunakan View Cell untuk komponen yang bisa digunakan ulang

### Fitur Tambahan (Improvisasi)

1. **Activity Logging:** Mencatat semua aktivitas user
2. **User Dashboard:** Halaman dashboard dengan statistik
3. **Session Timeout:** Auto-logout setelah 1 jam
4. **Modern UI:** Login page dengan gradient dan animasi
5. **Error Handling:** Try-catch untuk database errors
6. **Image Upload:** Fitur upload gambar untuk artikel
7. **Multiple User Roles:** Admin, Editor, dan User biasa

### Link ke Repository

- **Repository:** [Lab7Web CI4](https://github.com/username/lab7_ci4)
- **Live Demo:** [https://localhost/lab11_ci/ci4](https://localhost/lab11_ci/ci4)

---

## Cara Menjalankan Aplikasi

### Prerequisites
- XAMPP (Apache + MySQL)
- PHP 7.4+
- Composer

### Installation Steps

1. **Clone Repository**
   ```bash
   git clone [repository-url]
   cd lab11_ci/ci4
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Database Setup**
   ```bash
   # Import database
   mysql -u root -p lab_ci4 < complete_setup.sql
   
   # Run seeder
   php spark db:seed UserSeeder
   ```

4. **Start Application**
   ```bash
   php spark serve
   ```
   
   Atau akses langsung: `http://localhost/lab11_ci/ci4`

### Login Credentials
- **Email:** aziztriramadhan29@gmail.com
- **Password:** admin123

---

## Dokumentasi Screenshot

Semua screenshot tersedia di folder `/screenshots/` dengan penamaan:
- `1_X_[description].png` untuk Praktikum 1
- `2_X_[description].png` untuk Praktikum 2
- `3_X_[description].png` untuk Praktikum 3
- `4_X_[description].png` untuk Praktikum 4

### Screenshot yang Dibutuhkan

1. **Praktikum 1:**
   - Environment setup configuration
   - Directory structure view
   - Routes configuration and CLI verification
   - Controller creation
   - Auto routing demonstration
   - View creation and template usage

2. **Praktikum 2:**
   - Database table structure
   - Model implementation
   - CRUD operations (Create, Read, Update, Delete)
   - Form validation
   - Admin interface

3. **Praktikum 3:**
   - Layout system implementation
   - View Cell creation and usage
   - Template inheritance
   - Dynamic sidebar with recent articles

4. **Praktikum 4:**
   - User table and authentication
   - Login form and validation
   - Filter implementation
   - Protected routes testing
   - Dashboard creation

---

**Tanggal Penyelesaian:** 7 April 2026  
**Total Waktu Pengerjaan:** 4 Jam  
**Status:** Selesai dengan Improvisasi

## File Konfigurasi Penting

### Database Setup
- `complete_setup.sql` - Database dan tabel lengkap
- `MANUAL_SETUP.sql` - Setup manual step-by-step

### Login Configuration
- Email: `aziztriramadhan29@gmail.com`
- Password: `admin123`
- Hash: `$2y$10$53jkgq7pV1sdh4TFHXe1eOLqClZ1XR4kdVuh0M.4FL1kLCjOwuf8W`

### Routes Configuration
- Public routes: `/`, `/artikel`, `/about`, `/contact`
- Admin routes: `/admin/artikel` (protected)
- User routes: `/user/login`, `/user/logout`, `/user/dashboard`

### Error Handling
- Debug tools: `/debug/login`
- Activity logging: `writable/logs/user_activity.log`
- Session timeout: 1 hour

---

## Catatan Penting

1. **Environment:** Pastikan CI_ENVIRONMENT = development di .env
2. **Database:** Pastikan MySQL running dan database lab_ci4 exists
3. **Permissions:** Pastikan folder writable dapat ditulis
4. **URL Base:** Konfigurasi base_url di .env jika perlu
5. **Session:** Clear cache browser jika ada masalah login

---

**Dibuat dengan:** CodeIgniter 4 Framework  
**Versi PHP:** 7.4+  
**Database:** MySQL 5.7+
