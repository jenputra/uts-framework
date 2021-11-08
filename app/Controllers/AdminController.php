<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuModel;

class AdminController extends BaseController
{
    protected $bukuModel;
    public function __constuct()
    {

        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        $this->bukuModel = new BukuModel();
        $data = [
            'title' => "Home",
            'buku' => $this->bukuModel->getBuku()
        ];
        // $data['buku'] = $bukuModel->getBuku();
        //return view("admin/dashboard", $data);
        return view("admin/index", $data);
    }
    public function buat()
    {
        $data = [
            'title' => 'Form Tambah Data Buku',
            'validation' => \Config\Services::validation()
        ];
        return view('/admin/buat', $data);
    }
    public function save()
    {
        $this->bukuModel = new BukuModel();
        // //validasi mencegah data kosong dan data kembar
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[buku.judul.id.id]',
                'errors' => [
                    'required' => '{field} Buku harus diisi',
                    'is_unique' => '{field} Buku sudah terdaftar'
                ]
            ],
            //validasi untuk upload file
            'gambar_sampul' => [
                'rules' => 'is_image[gambar_sampul]|max_size[gambar_sampul,1024]|mime_in[gambar_sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    // 'uploaded' => 'silahkan pilih gambar terlebih dahulu',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'max_size' => 'gambar harus berukuran max. 1 Mb',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('AdminController/buat')->withInput();
        }

        $fileSampul = $this->request->getFile('gambar_sampul');
        //apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.png';
        } else {
            //generate nama sampul randoom
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan ke folder public/img 
            $fileSampul->move('img', $namaSampul);
            //ambil nama file 
            //$namaSampul = $fileSampul->getName();
        }
        $this->bukuModel->save([
            'Gambar_sampul' => $namaSampul,
            'judul' => $this->request->getVar('judul'),
            'pengarang' => $this->request->getVar('pengarang'),
            'penerbit' => $this->request->getVar('penerbit')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/AdminController');
    }
    public function detail($id_buku)
    {
        $this->bukuModel = new BukuModel();
        $data = [
            'title' => 'Detail Buku',
            'buku' => $this->bukuModel->getBuku($id_buku)
        ];
        //kondisi jika slug tidak ada di database
        if (empty($data['buku'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Id Buku ' . $id_buku  . ' tidak ditemukan.');
        }
        return view('admin/detail', $data);
    }
    public function edit($id_buku)
    {
        $this->bukuModel = new BukuModel();
        $data = [
            'title' => 'Form update Data Buku',
            'validation' => \Config\Services::validation(),
            'buku' => $this->bukuModel->getBuku($id_buku)
        ];
        return view('Admin/edit', $data);
    }
    public function update($id)
    {
        $this->bukuModel = new BukuModel();
        //cek judul
        $bukuLama = $this->bukuModel->getBuku($this->request->getVar('id_buku'));
        if ($bukuLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[buku.judul]';
        }
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} buku harus diisi',
                    'is_unique' => '{field} buku sudah terdaftar'
                ],
                'Gambar_sampul' => [
                    'rules' => 'is_image[Gambar_sampul]|max_size[Gambar_sampul,1024]|mime_in[Gambar_sampul,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        // 'uploaded' => 'silahkan pilih gambar terlebih dahulu',
                        'is_image' => 'yang anda pilih bukan gambar',
                        'max_size' => 'gambar harus berukuran max. 1 Mb',
                        'mime_in' => 'yang anda pilih bukan gambar'
                    ]
                ]
            ]
        ])) {
            //mengambilErrorMessage
            // $validation = \Config\Services::validation();
            return redirect()->to('AdminController/edit/' . $this->request->getVar('id_buku'))->withInput();
        }
        $fileSampul = $this->request->getFile('Gambar_sampul');
        //cek gambar apakah tetap menggunakan gambar lama?
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getvar('sampulLama');
        } else {
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaSampul);
            unlink('img/' . $this->request->getvar('sampulLama'));
        }
        //upload data
        $this->bukuModel->save([
            'id_buku' => $id,
            'judul' => $this->request->getVar('judul'),
            'pengarang' => $this->request->getVar('pengarang'),
            'penerbit' => $this->request->getVar('penerbit'),
            'Gambar_sampul' => $namaSampul
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diupdate.');
        return redirect()->to('/AdminController');
    }
    public function delete($id_buku)
    {
        $this->bukuModel = new BukuModel();
        $this->bukuModel->delete($id_buku);
        return redirect()->to('/AdminController');
    }
}
