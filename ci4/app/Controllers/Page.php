<?php
namespace App\Controllers;

class Page extends BaseController
{
    public function about()
    {
        return view('about', [
            'title' => 'Halaman Abot',
            'content' => 'Ini adalah halaman abaut yang menjelaskan tentang isi halaman ini.'
        ]);
    }
    
    public function contact()
    {
        return view('contact', [
            'title' => 'Halaman Kontak',
            'content' => 'Ini adalah halaman kontak yang berisi informasi cara menghubungi kami.'
        ]);
    }
    
    public function faqs()
    {
        return view('faqs', [
            'title' => 'Halaman FAQ',
            'content' => 'Ini adalah halaman Frequently Asked Questions (FAQ) yang berisi pertanyaan yang sering diajukan.'
        ]);
    }
}
