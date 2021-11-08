<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $primaryKey = 'id_buku';
    protected $table = 'buku';
    protected $useTimestamps = 'false';
    protected $allowedFields = ['Gambar_sampul', 'judul', 'pengarang', 'penerbit'];
    public function getBuku($id_buku = false)
    {
        if ($id_buku === false) {
            return $this->findAll();
        } else {
            return $this->Where(['id_buku' => $id_buku])->first();
        }
    }
}
