<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $title = 'Beranda';
        $content = 'Selamat datang di website sederhana menggunakan CodeIgniter 4. Ini adalah halaman beranda yang menampilkan konten utama.';
        return view('home', compact('title', 'content'));
    }
}
