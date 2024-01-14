<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\UserModel;

class User extends BaseController
{
    protected $user;
    protected $buku;
    protected $kategori;
    protected $request;
    protected $validation;

    public function __construct()
    {
        $this->user = new UserModel();
        $this->buku = new BukuModel();
        $this->kategori = new KategoriModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        if (session()->get('role') != 2) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $data = [
            'buku' => $this->buku->tampilBukuTerbaru(),
            'view' => $this->buku->bukuDilihat(),
        ];
        return view('user/index', $data);
    }

    public function mahasiswa()
    {
        if (session()->get('role') != 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        return view('admin/mahasiswa');
    }

    public function dosen()
    {
        if (session()->get('role') != 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        return view('admin/dosen');
    }

    public function getAllMahasiswa()
    {
        $data['data'] = [];
        $result = $this->user->where(['status' => 'mahasiswa'])->findAll();
        $no = 1;
        foreach ($result as $key => $value) {
            $data['data'][$key] = [
                $no,
                $value['nama'],
                $value['email'],
                $value['jenkel'] == "L" ? "Laki-Laki" : "Perempuan",
                $value['status'],
                $value['prodi'],
            ];
            $no++;
        }
        return $this->response->setJSON($data);
    }

    public function getAllDosen()
    {
        $data['data'] = [];
        $result = $this->user->where(['status' => 'dosen'])->findAll();
        $no = 1;
        foreach ($result as $key => $value) {
            $data['data'][$key] = [
                $no,
                $value['nama'],
                $value['email'],
                $value['jenkel'] == "L" ? "Laki-Laki" : "Perempuan",
                $value['status'],
                $value['prodi'],
            ];
            $no++;
        }
        return $this->response->setJSON($data);
    }

    public function getAllAdmin()
    {
        $data['data'] = [];
        $result = $this->user->where(['status' => 'admin'])->findAll();
        $no = 1;
        foreach ($result as $key => $value) {
            $data['data'][$key] = [
                $no,
                $value['nama'],
                $value['email'],
                $value['jenkel'] == "L" ? "Laki-Laki" : "Perempuan",
                $value['status']
            ];
            $no++;
        }
        return $this->response->setJSON($data);
    }

    public function buku()
    {
        if (session()->get('role') != 2) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $data = [
            'kategori'      => $this->kategori->findAll(),
        ];
        return view('user/buku', $data);
    }

    public function getBuku()
    {
        // $uri = service('uri');

        $keyword = $this->request->getPost('keyword');

        // var_dump($keyword);
        // die;

        $filterBook = $this->buku->filterBuku($keyword);
        $allBook = $this->buku->allBook();

        $book = '';

        if ($keyword != null) {
            foreach ($filterBook as $value) {
                $book .= '
                <div class="col-lg-2" >
                    <a href="<?= base_url() ?>user/title/' . $value['id_buku'] . '">
                        <div class="card shadow-lg">
                            <img src="/gambar/' . $value['cover_buku'] . '" class="card-img-top" style="width: auto; height:210px">
                            <div class="card-body" style="padding: 0px 4px;">
                            <div class="d-flex justify-content-between align-items-center py-2">
                                <span class="badge badge-success">' . $value['kategori'] . '</span>
                                <span style="color: black; font-size: 10px;"><i class="fa fa-eye"></i>' . $value['view'] . '</span>
                            </div>
                            <div class="border-bottom border-dark">
                            </div>
                            <div>
                                <p class="card-title text-truncate" style="font-size: 13px; color: black; font-weight: 500; margin: 0px">' . $value['judul'] . '</p>
                                <p class="card-title text-truncate" style="font-size: 13px; color: black; margin: 0px">' . $value['penulis'] . '</p>
                            </div>
                            </div>
                        </div>
                    </a>
                </div>  
                ';
            }
        } else {
            foreach ($allBook as $value) {
                $book .= '
                <div class="col-lg-2" >
                    <a href="<?= base_url() ?>user/title/' . $value['id_buku'] . '">
                        <div class="card shadow-lg">
                            <img src="/gambar/' . $value['cover_buku'] . '" class="card-img-top" style="width: auto; height:210px">
                            <div class="card-body" style="padding: 0px 4px;">
                            <div class="d-flex justify-content-between align-items-center py-2">
                                <span class="badge badge-success">' . $value['kategori'] . '</span>
                                <span style="color: black; font-size: 10px;"><i class="fa fa-eye"></i>' . $value['view'] . '</span>
                            </div>
                            <div class="border-bottom border-dark">
                            </div>
                            <div>
                                <p class="card-title text-truncate" style="font-size: 13px; color: black; font-weight: 500; margin: 0px">' . $value['judul'] . '</p>
                                <p class="card-title text-truncate" style="font-size: 13px; color: black; margin: 0px">' . $value['penulis'] . '</p>
                            </div>
                            </div>
                        </div>
                    </a>
                </div>   
            ';
            }
        }

        return $this->response->setJSON(['status' => $book]);
    }

    public function detail($id)
    {
        if (session()->get('role') != 2) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $data = [
            'tampil' => $this->buku->tampilBuku(),
            'buku' => $this->buku->detailBuku($id)
        ];
        return view('user/detail', $data);
    }

    public function view($id)
    {
        if (session()->get('role') != 2) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $data = [
            'buku' => $this->buku->viewBuku($id)
        ];
        return view('user/view', $data);
    }

    public function profil()
    {
        if (session()->get('role') != 2) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $id = session()->get('id_user');

        $data = [
            'jenkel' => ['L', 'P'],
            'pengguna' => $this->user->fetchUser($id)
        ];
        return view("user/profil", $data);
    }
}
