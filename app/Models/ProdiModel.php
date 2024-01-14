<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_prodi';
    protected $primaryKey       = 'id_prodi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'prodi'
    ];

    public function TambahProdi($simpandata)
    {
        return $this->db->table('tb_prodi')->insert($simpandata);
    }

    public function UpdateProdi($id, $simpandata)
    {
        return $this->update(['id_prodi' => $id], $simpandata);
    }

    public function DeleteProdi($id)
    {
        return $this->delete(['id_prodi' => $id]);
    }
}
