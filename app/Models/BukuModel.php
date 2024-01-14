<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_buku';
    protected $primaryKey       = 'id_buku';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'judul', 'kategori_id', 'penulis', 'penerbit', 'tahun_terbit', 'deskripsi', 'cover_buku', 'file_buku', 'view'
    ];

    public function TambahBuku($data)
    {
        return $this->db->table('tb_buku')->insert($data);
    }

    public function UpdateBuku($id, $simpandata)
    {
        return $this->update(['id_buku' => $id], $simpandata);
    }

    public function DeleteBuku($id)
    {
        return $this->delete(['id_buku' => $id]);
    }

    public function tampilBuku()
    {
        $getData = $this->db->table('tb_buku');
        $getData->join('tb_kategori', 'tb_kategori.id_kategori = tb_buku.kategori_id');
        $query = $getData->get();
        return $query->getResultArray();
    }

    public function allBook()
    {
        return $this->db->table('tb_buku')->join('tb_kategori', 'tb_kategori.id_kategori = tb_buku.kategori_id')->get()->getResultArray();
    }

    public function filterBuku($keyword)
    {
        return $this->db->table('tb_buku')->join('tb_kategori', 'tb_kategori.id_kategori = tb_buku.kategori_id')->where(['kategori_id' => $keyword])->get()->getResultArray();
    }

    public function tampilBukuTerbaru()
    {
        $getData = $this->db->table('tb_buku');
        $getData->join('tb_kategori', 'tb_kategori.id_kategori = tb_buku.kategori_id');
        $getData->orderBy('id_buku', 'DESC');
        $getData->limit(30);
        $query = $getData->get();
        return $query->getResultArray();
    }

    public function detailBuku($id)
    {
        $GetData = "SELECT tb_buku.*, tb_kategori.kategori AS nama_kategori FROM tb_buku LEFT JOIN tb_kategori ON tb_buku.kategori_id = tb_kategori.id_kategori WHERE tb_buku.id_buku = $id";
        $GetData = $this->db->query($GetData)->getRowArray();
        return $GetData;
    }

    public function updateView($id, $updateview)
    {
        return $this->update(['id_buku' => $id], $updateview);
    }

    public function viewBuku($id)
    {
        $GetData = "SELECT tb_buku.*, tb_kategori.kategori AS nama_kategori FROM tb_buku LEFT JOIN tb_kategori ON tb_buku.kategori_id = tb_kategori.id_kategori WHERE tb_buku.id_buku = $id";
        $GetData = $this->db->query($GetData)->getRowArray();
        return $GetData;
    }

    public function bukuDilihat()
    {
        $getData = $this->db->table('tb_buku');
        $getData->join('tb_kategori', 'tb_kategori.id_kategori = tb_buku.kategori_id');
        $getData->orderBy('view', 'DESC');
        $getData->limit(10);
        $query = $getData->get();
        return $query->getResultArray();
    }
}
