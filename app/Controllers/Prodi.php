<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdiModel;

class Prodi extends BaseController
{
    protected $prodi;
    protected $validation;

    public function __construct()
    {
        $this->prodi = new ProdiModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        if (session()->get('role') != 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        return view("admin/prodi");
    }

    public function getAll()
    {
        $data['data'] = [];
        $result = $this->prodi->select()->findAll();
        $no = 1;
        foreach ($result as $key => $value) {
            $ops = '<tr>';
            $ops .= '<a class="btn btn-success text-white" onclick="Edit(' . $value['id_prodi'] . ')"><i class="fa fa-pencil"></i></a>';
            $ops .= '<a class="btn btn-danger text-white" onclick="Delete(' . $value['id_prodi'] . ')"><i class="fa fa-trash"></i></a>';
            $ops .= '</tr>';
            $data['data'][$key] = [
                $no,
                $value['prodi'],
                $ops
            ];
            $no++;
        }
        return $this->response->setJSON($data);
    }

    public function create()
    {
        $valid = $this->validate([
            'en_prodi' => [
                'label' => 'Program Studi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!!'
                ]
            ],
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'en_prodi' => $this->validation->getError('en_prodi'),
                ]
            ];

            return $this->response->setJSON($msg);
        } else {

            $simpandata = [
                'prodi' => $this->request->getPost('en_prodi'),
            ];

            $status = $this->prodi->TambahProdi($simpandata);

            if ($status) {
                $respon = [
                    'status' => true,
                    'msg' => 'Data program studi berhasil ditambah!!'
                ];
            } else {
                $respon = [
                    'status' => false,
                    'msg' => 'Maaf, data program studi gagal ditambah!!'
                ];
            }

            return $this->response->setJSON($respon);
        }
    }

    public function getOne()
    {
        $id = $this->request->getPost('id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->prodi->where('id_prodi', $id)->first();

            return $this->response->setJSON($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function update()
    {
        $id = $this->request->getPost("en_id");

        $simpandata = [
            'prodi' => $this->request->getPost('en_prodi'),
        ];

        // var_dump($simpandata);
        // die();

        $status = $this->prodi->UpdateProdi($id, $simpandata);

        if ($status) {
            $respon = [
                'status' => true,
                'msg' => 'Data program studi berhasil diubah!!'
            ];
        } else {
            $respon = [
                'status' => false,
                'msg' => 'Maaf, Data program studi gagal diubah!!!!'
            ];
        }

        return $this->response->setJSON($respon);
    }

    public function delete()
    {
        $id = $this->request->getPost("id");

        $status = $this->prodi->DeleteProdi($id);

        if ($status) {
            $respon = [
                'status' => true,
                'msg' => 'Data program studi berhasil dihapus!!'
            ];
        } else {
            $respon = [
                'status' => false,
                'msg' => 'Maaf, data program studi berhasil dihapus!!'
            ];
        }

        return $this->response->setJSON($respon);
    }
}
