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

 public function view($slug)
 {
 $model = new ArtikelModel();
 $artikel = $model->where([
 'slug' => $slug
 ])->first();

 // Menampilkan error apabila data tidak ada.
 if (!$artikel) 
 {
 throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
 }

 $title = $artikel['judul'];
 return view('artikel/detail', compact('artikel', 'title'));
 }

 public function admin_index() 
 {
 $title = 'Daftar Artikel';
 $model = new ArtikelModel();
 $artikel = $model->findAll();
 return view('artikel/admin_index', compact('artikel', 'title'));
 }

 public function add() 
 {
 // validasi data.
 $validation = \Config\Services::validation();
 $validation->setRules([
     'judul' => 'required',
     'isi' => 'required',
     'gambar' => 'uploaded[gambar]|max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
 ]);
 $isDataValid = $validation->withRequest($this->request)->run();

 if ($isDataValid)
 {
     $artikel = new ArtikelModel();
     
     // Handle upload gambar
     $gambar = $this->request->getFile('gambar');
     $namaGambar = '';
     
     if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
         $namaGambar = $gambar->getRandomName();
         $gambar->move('gambar', $namaGambar);
     }
     
     $artikel->insert([
         'judul' => $this->request->getPost('judul'),
         'isi' => $this->request->getPost('isi'),
         'slug' => url_title($this->request->getPost('judul')),
         'gambar' => $namaGambar,
         'status' => 1
     ]);
     return redirect('admin/artikel');
 }

 $title = "Tambah Artikel";
 return view('artikel/form_add', compact('title'));
 }

 public function edit($id) 
 {
 $artikel = new ArtikelModel();

 // validasi data.
 $validation = \Config\Services::validation();
 $validation->setRules([
     'judul' => 'required',
     'isi' => 'required',
     'gambar' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
 ]);
 $isDataValid = $validation->withRequest($this->request)->run();

 if ($isDataValid)
 {
     // Handle upload gambar
     $gambar = $this->request->getFile('gambar');
     $namaGambar = $this->request->getPost('gambar_lama');
     
     if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
         // Hapus gambar lama jika ada
         if ($namaGambar && file_exists('gambar/' . $namaGambar)) {
             unlink('gambar/' . $namaGambar);
         }
         
         $namaGambar = $gambar->getRandomName();
         $gambar->move('gambar', $namaGambar);
     }
     
     $artikel->update($id, [
         'judul' => $this->request->getPost('judul'),
         'isi' => $this->request->getPost('isi'),
         'gambar' => $namaGambar,
     ]);
     return redirect('admin/artikel');
 }

 // ambil data lama
 $data = $artikel->where('id', $id)->first();
 $title = "Edit Artikel";
 return view('artikel/form_edit', compact('title', 'data'));
 }

 public function delete($id) 
 {
 $artikel = new ArtikelModel();
 
 // Hapus gambar jika ada
 $data = $artikel->where('id', $id)->first();
 if ($data && $data['gambar'] && file_exists('gambar/' . $data['gambar'])) {
     unlink('gambar/' . $data['gambar']);
 }
 
 $artikel->delete($id);
 return redirect('admin/artikel');
 }
}