<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $kategori;
    protected $validation;

    public function __construct()
    {
        $this->kategori = new KategoriModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        if (session()->get('role') != 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        return view("admin/kategori");
    }

    public function getAll()
    {
        $data['data'] = array();
        $result = $this->kategori->select()->findAll();
        $no = 1;
        foreach ($result as $key => $value) {
            $ops = '<tr>';
            $ops .= '<a class="btn btn-success text-white" onclick="Edit(' . $value['id_kategori'] . ')"><i class="fa fa-pencil"></i></a>';
            $ops .= '<a class="btn btn-danger text-white" onclick="Delete(' . $value['id_kategori'] . ')"><i class="fa fa-trash"></i></a>';
            $ops .= '</tr>';
            $data['data'][$key] = array(
                $no,
                $value['kategori'],
                $ops
            );
            $no++;
        }
        return $this->response->setJSON($data);
    }

    public function create()
    {
        $valid = $this->validate([
            'en_kategori' => [
                'label' => 'Kategori Buku',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!!'
                ]
            ],
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'en_kategori' => $this->validation->getError('en_kategori'),
                ]
            ];

            return $this->response->setJSON($msg);
        } else {

            $simpandata = [
                'kategori' => $this->request->getPost('en_kategori'),
            ];

            $status = $this->kategori->TambahKategori($simpandata);

            if ($status) {
                $respon = [
                    'status' => true,
                    'msg' => 'Kategori berhasil ditambah!!'
                ];
            } else {
                $respon = [
                    'status' => false,
                    'msg' => 'Maaf, kategori gagal ditambah!!'
                ];
            }

            return $this->response->setJSON($respon);
        }
    }

    public function getOne()
    {
        $id = $this->request->getPost('id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->kategori->where('id_kategori', $id)->first();

            return $this->response->setJSON($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function update()
    {
        $id = $this->request->getPost("en_id");

        $simpandata = [
            'kategori' => $this->request->getPost('en_kategori'),
        ];

        $status = $this->kategori->UpdateKategori($id, $simpandata);

        if ($status) {
            $respon = [
                'status' => true,
                'msg' => 'Kategori berhasil diubah!!'
            ];
        } else {
            $respon = [
                'status' => false,
                'msg' => 'Maaf, kategori gagal diubah!!'
            ];
        }

        return $this->response->setJSON($respon);
    }

    public function delete()
    {
        $id = $this->request->getPost("id");

        $status = $this->kategori->DeleteKategori($id);

        if ($status) {
            $respon = [
                'status' => true,
                'msg' => 'Kategori berhasil dihapus!!'
            ];
        } else {
            $respon = [
                'status' => false,
                'msg' => 'Maaf, kategori gagal dihapus!!'
            ];
        }

        return $this->response->setJSON($respon);
    }
}
