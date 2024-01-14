<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama', 'no_induk', 'email', 'password', 'jenkel', 'alamat', 'telp', 'status', 'foto', 'prodi', 'role_id'
    ];

    public function TambahUser($simpandata)
    {
        return $this->db->table("tb_user")->insert($simpandata);
    }

    public function updateUser($id, $simpandata)
    {
        return $this->update(['id_user' => $id], $simpandata);
    }

    public function DeleteUser($id)
    {
        return $this->delete(['id_user' => $id]);
    }

    public function cekuser($email)
    {
        $getData = $this->db->table('tb_user');
        $getData->where(['email' => $email]);
        $query = $getData->get();
        return $query->getRowArray();
    }

    public function fetchUser($id)
    {
        $getData = $this->db->table('tb_user');
        $getData->where(['id_user' => $id]);
        $query = $getData->get();
        return $query->getRowArray();
    }
}
