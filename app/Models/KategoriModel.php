<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_kategori';
    protected $primaryKey       = 'id_kategori';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kategori'
    ];

    public function TambahKategori($simpandata)
    {
        return $this->db->table('tb_kategori')->insert($simpandata);
    }

    public function UpdateKategori($id, $simpandata)
    {
        return $this->update(['id_kategori' => $id], $simpandata);
    }

    public function DeleteKategori($id)
    {
        return $this->delete(['id_kategori' => $id]);
    }
}
