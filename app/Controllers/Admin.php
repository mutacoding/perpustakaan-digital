<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    protected $buku;
    protected $kategori;
    protected $user;

    public function __construct()
    {
        $this->buku = new BukuModel();
        $this->kategori = new KategoriModel();
        $this->user = new UserModel();
    }

    public function index()
    {
        if (session()->get('role') != 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $data = [
            'jmlbuku'       => $this->buku->countAllResults(),
            'jmlkategori'   => $this->kategori->countAllResults(),
            'jmlpengguna'  => $this->user->where(['role_id' => 2])->countAllResults(),
        ];
        return view("admin/index", $data,);
    }

    public function profil()
    {
        if (session()->get('role') != 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $id = session()->get('id_user');

        $data = [
            'jenkel' => ['L', 'P'],
            'pengguna' => $this->user->find($id)
        ];
        return view("admin/profil", $data);
    }
}
