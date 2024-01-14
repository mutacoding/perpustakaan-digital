<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'tb_contact';
  protected $primaryKey       = 'id_contact';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [
    'email', 'pesan'
  ];

  public function TambahContact($simpandata)
  {
    return $this->db->table('tb_contact')->insert($simpandata);
  }
}
